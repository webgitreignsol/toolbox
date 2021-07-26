<?php

namespace App;
use App\Classes\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Frontend\User\GetProfile as GetUserProfile;
use App\Http\Resources\Frontend\Vendor\Listing as VendorListings;
use App\UserProfile;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use LogsActivity;


    protected $guard = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'added_by', 'updated_by', 'name', 'country_code', 'phone', 'email', 'type', 'password', 'otp', 'device_type', 'device_token', 'verified_by', 'social_provider', 'social_token', 'social_id',
    ];

    protected $appends = ['ratings'];

    protected static $logAttributes = ['added_by', 'updated_by', 'name', 'country_code', 'phone', 'email', 'type', 'password', 'otp', 'device_type', 'device_token', 'verified_by', 'social_provider', 'social_token', 'social_id'];
    protected static $logName = 'User';
    protected static $logOnlyDirty = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getRatingsAttribute($val) {
        $count = Rating::where('get_review', $this->id)
                 ->avg('rating');
                 return $count ?? 0;
    }

    // Auth Section Start Created by MYTECH

    public static function verifyOtp($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'otp' => 'required|numeric|digits:4'
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        $user = User::where('email', $request->email)->first();

        if($user) {
            if($request->otp == $user->otp) {
                if ($user->verified_by == 'email' && $user->email_verified_at == '' || $request->email) {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->otp = null;
                    if ($request->email) {
                        $user->email = $request->email;
                    }
                    $user->save();

                    return $user;
                } else {
                    return ['error' => 'User is already verified'];
                }
            } else {
                return 'Please enter valid otp';
            }
        } else {
            return 'User is invalid';
        }
    }

    public function resendOtp($request)
    {
        $record = $this::whereNotNull('otp');

        $record = $this::query();

        if ($request->email)
        {
            $record->where('email', $request->email);
        }

        $record = $record->first();

        if (!$record)
        {
            return 'Invalid User';
        }

        if($record->verified_by == 'email') {
            $data = [
                'email' => $record->email,
                'name' => $record->name,
                'subject' => 'Resend Account verification code',
            ];

            Helper::sendEmail('accountVerification', ['data' => $record], $data);
        }

        return $record;
    }

    public function login($request)
    {
        if($request->has('email')) {
            $validationRules['email'] = 'required|string|email';
        }
        $validationRules['password'] = 'required|string|min:8|max:16';
        $validationRules['device_type'] = 'in:android,ios';
        $validationRules['device_token'] = 'string|max:255';

        $validator = Validator::make($request->all(), $validationRules);

        if($validator->fails()) {
            return $validator;
        }

        $attempt_by_email = $user = User::where('email', $request->email)->first();

        if($attempt_by_email) {
            $credentials = ['email' => $request->email, 'password' => $request->password];
        }

        if(!$user) {
            return "Invalid Credentials";
        }

        if(!Auth::guard('frontend')->attempt($credentials))
            return 'Invalid Credentials';

        if($attempt_by_email && Auth::guard('frontend')->user()->email_verified_at == '') {

            $user->otp = mt_rand(1000, 9999);
            $user->save();

            $data = [
                'email' => $user->email,
                'name' => $user->name,
                'subject' => 'Account verification code',
            ];

            Helper::sendEmail('accountVerification', ['data' => $user], $data);

            return ['error' => 'User is not verified', 'user' => $user];

        }

        $user = Auth::guard('frontend')->user();

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        if($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        $device_type = $request->has('device_type') ? $request->device_type : '';
        $device_token = $request->has('device_token') ? $request->device_token : '';

        if($device_type) {

            $user->device_type  = $device_type;
            $user->device_token = $device_token;

            $user->save();
            try {

            } catch(\Exception $eex) {

            }
        }

        $user->token = $tokenResult->accessToken;
        // $user->roles = $user->roles ?? [];
        return $user;
    }

    public function signup($request)
    {
        $validationRules['name'] = 'required|string|min:3|max:55';
        $validationRules['password'] = 'required|string|min:8|max:16|confirmed';
        $validationRules['verified_by'] = 'required|in:email';
        $validationRules['email'] = 'required|string|email|min:5|max:155|unique:users';
        $validationRules['country_code'] = 'required|numeric';
        $validationRules['phone'] = 'required|numeric|digits_between:9,14|unique:users';
        $validationRules['type'] = 'required|in:customer,vendor';

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $validator;
        }

        if ($request->verified_by == 'email') {
            $type = 'email';
            $token = mt_rand(1000, 9999);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => bcrypt($request->password),
            'verified_by' => $type,
            'otp' => $token,
        ];

        $this->fill($data);
        $this->save();

        if ($this->verified_by == 'email') {
            $data = [
                'email' => $this->email,
                'name' => $this->name,
                'subject' => 'Account verification code',
            ];

            Helper::sendEmail('accountVerification', ['data' => $this], $data);
        }

        return $this;

    }

    public function forgotPassword($request)
    {
        $record = $this::where('email', $request->email)->first();

        $requestFor = 'email';

        if (!$record)
        {
            return 'invalid email';
        }

        $record->otp = mt_rand(1111, 9999);
        $record->verified_by = $requestFor;
        $record->save();

        if ($requestFor = 'email')
        {
            $data = [
                'email' => $record->email,
                'name' => $record->name,
                'subject' => 'Account recovery code',
            ];

            Helper::sendEmail('accountVerification', ['data' => $record], $data);
        }

        return $record;
    }

    public function verifyForgetCode($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'otp' => 'required|numeric|digits:4'
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        $record = $this::where('email', $request->email)->first();

        if (!$record)
        {
            return 'Invalid user';
        }

        if ($record->otp == null)
        {
            return ['error' => 'User is already verified'];
        }

        if ($record->otp != $request->otp)
        {
            return 'Please enter valid otp';
        }

        $record->otp = null;
        $record->save();

        if ($record->verified_by = 'email')
        {
            $data = [
                'email' => $record->email,
                'name' => $record->name,
                'subject' => 'Account recovery code',
            ];

            Helper::sendEmail('accountVerification', ['data' => $record], $data);
        }

        return $record;
    }

    public function updatePassword($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|max:16|confirmed'
        ]);

        if ($validator->fails())
        {
            return $validator;
        }

        $record = $this::find($id);
        if (Hash::check($request->old_password, $record->password)) {
            $record->password = bcrypt($request->password);
            $record->save();
        } else {
            return 'Current password doesn,t match';
        }

        return $record;
    }

    public function updateProfile($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,55',
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        $record = $this::find($id);
        $record->name = $request->name;
        $record->save();

        if ($record) {

            $fileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/user-profile', $fileName);
            }

            $userProfile = UserProfile::where('user_id', $record->id)->first();
            if ($userProfile) {
                $userProfile->location = $request->location;
                $userProfile->image = '/uploads/user-profile/'.$fileName;
                $userProfile->save();
            } else {
                $userProfile = new UserProfile();
                $userProfile->location = $request->location;
                $userProfile->image = '/uploads/user-profile/'.$fileName;
                $userProfile->user_id = \Auth::user()->id;
                $userProfile->save();
            }
        }

        return $record;
    }

    public function getProfile($request, $id)
    {
        $record = $this->find($id);

        if (!$record) {
            return 'Unauthorized';
        }

        return (new GetUserProfile($record))->resolve();
    }

    public function userFacebookAuth($request)
    {
        $validationRules['name'] = 'required|string|min:3|max:55';
        $validationRules['email'] = 'required|string|email|min:5|max:155';
        $validationRules['social_token'] = 'required|string';

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $validator;
        }

        $record = $this::where('social_token', $request->social_token)
        ->first();

        if (!$record)
        {
            $record = $this;

            $record->name = $request->name;
            $record->email = $request->email;
            $record->verified_by  = 'facebook';
            $record->social_id = $request->social_token;
            $record->password = bcrypt('facebookPassword');
            $record->social_provider = 'facebook';
            $record->social_token = $request->social_token;
            $record->email_verified_at = date('Y-m-d H:i:s');

            $record->save();
        }

        if (!Auth::guard('frontend')->loginUsingId($record->id))
        {
            return 'Something wen\'t wrong';
        }

        if (Auth::guard('frontend')->user())
        {
            $user = Auth::guard('frontend')->user();
        }

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        if ($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        $device_type = $request->has('device_type') ? $request->device_type : '';
        $device_token = $request->has('device_token') ? $request->device_token : '';

        if ($device_token && $device_type)
        {
            $user->device_type   = $device_type;
            $user->device_token  = $device_token;

            $user->save();
        }

        $user->token = 'Bearer ' . $tokenResult->accessToken;
        // $user->roles = $user->roles ?? [];

        return $user;
    }

    public function userGoogleAuth($request)
    {
        $validationRules['name'] = 'required|string|min:3|max:55';
        $validationRules['email'] = 'required|string|email|min:5|max:155';
        $validationRules['social_token'] = 'required|string';

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $validator;
        }

        $record = $this::where('social_token', $request->social_token)
            ->first();

        if (!$record)
        {
            $record = $this;

            $record->name = $request->name;
            $record->email = $request->email;
            $record->verified_by  = 'google';
            $record->social_id = $request->social_token;
            $record->password = bcrypt('googlePassword');
            $record->social_provider = 'google';
            $record->social_token = $request->social_token;
            $record->email_verified_at = date('Y-m-d H:i:s');

            $record->save();
        }

        if (!Auth::guard('frontend')->loginUsingId($record->id))
        {
            return 'Something wen\'t wrong';
        }

        if (Auth::guard('frontend')->user())
        {
            $user = Auth::guard('frontend')->user();
        }

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        if ($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        $device_type = $request->has('device_type') ? $request->device_type : '';
        $device_token = $request->has('device_token') ? $request->device_token : '';

        if ($device_token && $device_type)
        {
            $user->device_type   = $device_type;
            $user->device_token  = $device_token;

            $user->save();
        }

        $user->token = 'Bearer ' . $tokenResult->accessToken;
        // $user->roles = $user->roles ?? [];

        return $user;
    }

    public function userAppleAuth($request)
    {
        $validationRules['name'] = 'required|string|min:3|max:55';
        $validationRules['email'] = 'required|string|email|min:5|max:155';
        $validationRules['social_token'] = 'required|string';

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $validator;
        }

        $record = $this::where('social_token', $request->social_token)
            ->first();

        if (!$record)
        {
            $record = $this;

            $record->name = $request->name;
            $record->email = $request->email;
            $record->verified_by  = 'apple';
            $record->social_id = $request->social_token;
            $record->password = bcrypt('applePassword');
            $record->social_provider = 'apple';
            $record->social_token = $request->social_token;
            $record->email_verified_at = date('Y-m-d H:i:s');

            $record->save();
        }

        if (!Auth::guard('frontend')->loginUsingId($record->id))
        {
            return 'Something wen\'t wrong';
        }

        if (Auth::guard('frontend')->user())
        {
            $user = Auth::guard('frontend')->user();
        }

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        if ($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        $device_type = $request->has('device_type') ? $request->device_type : '';
        $device_token = $request->has('device_token') ? $request->device_token : '';

        if ($device_token && $device_type)
        {
            $user->device_type   = $device_type;
            $user->device_token  = $device_token;

            $user->save();
        }

        $user->token = 'Bearer ' . $tokenResult->accessToken;
        // $user->roles = $user->roles ?? [];

        return $user;
    }

    public function signOut($request)
    {
        try
        {
            $user = $request->user();
            $user->device_token = null;
            $user->device_type = null;
            $user->save();
            $request->user()->token()->revoke();
        }
        catch (\Exception $exception)
        {
            if ($exception instanceof \Illuminate\Auth\AuthenticationException)
            {
                return 'The session is already logged out';
            }
        }

        return $user;
    }
    // Auth Section End Created by MYTECH


    public function user_profiles()
    {

        return $this->HasOne('App\UserProfile');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'user_has_services', 'user_id', 'service_id');
    }

    public function jobs(){

        return $this->hasMany('App\Job', 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating', 'driver_id');
    }



    // Resources Start Created By MYTECH
    public function vendorListing($request)
    {
        $records = $this::with(
            'user_profiles'
        )
        ->orderBy('created_at', 'desc')
        ->get();

        $result = [];

        if (count($records) > 0)
        {
            $result = VendorListings::collection($records)->toArray($request);
        }

        return $result;
    }
    // Rescources End Created By MYTECH
}
