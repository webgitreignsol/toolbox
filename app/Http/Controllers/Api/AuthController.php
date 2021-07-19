<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Frontend\User\GetProfile as GetUserProfile;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Classes\Helper;
use Validator;
use App\User;
use App\UserProfile;
use Auth;
use Carbon\Carbon;
use App\Rating;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->has('email')) {
            $validationRules['email'] = 'required|string|email';
        }
        $validationRules['password'] = 'required|string|min:8|max:16';
        $validationRules['device_type'] = 'in:android,ios';
        $validationRules['device_token'] = 'string|max:255';

        $validator = Validator::make($request->all(), $validationRules);

        if($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
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

        if($device_token && $device_type) {

            $user->device_type  = $device_type;
            $user->device_token = $device_token;

            $user->save();
            try {

            } catch(\Exception $eex) {

            }
        }

        $user->token = 'Bearer ' . $tokenResult->accessToken;
        // $user->roles = $user->roles ?? [];
        return $user;
    }

    public function getProfile($id)
    {
        
        $user = User::with('user_profiles')->where('id',$id)->first();
        $count = Rating::where('driver_id', $user->id)->avg('rating');

        if ($user) {
            return response()->json(["status" => 1, "message" => 'User Match Succesfully', "data" => [$user, $count]]);
        } else {
            return response()->json(["status" => 0, "message" => 'Undefined User', "data" => []]);
        }

    }

    public function createProfile(Request $request)
    {
        $rules=[
            'location'   =>'required',
            'image'      => 'required|image',
            'bio'        => 'required'
        ];

         $validator = Validator::make($request->all(), $rules);

         if($validator->fails()) {
             return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
         }

        $image = $request->file('image');
        $image_name = rand().'.'. $image->getClientOriginalExtension();
        $image->move(public_path('assets/admin/userImg/'), $image_name);

        $profile = new UserProfile;

        $profile->location = $request->location;
        $profile->bio = $request->bio;
        $profile->latitude = $request->latitude;
        $profile->longitude = $request->longitude;
        $profile->image = $image_name;
        $profile->user_id = Auth::user()->id;
        $profile->save();

        if ($profile) {
            return response()->json(["status" => 1, "message" => 'Profile Create Succesfully', "data" => $profile]);
        }

    }

    public function updateProfile(Request $request,$id)
    {
        $user = UserProfile::find($id);

        $rules=[
            'location'   =>'required',
            'image'      => 'required|image',
            'bio'        => 'required'
        ];

        $currentImage = $user->image;

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
        }

        $image = $request->file('image');
        $image_name = rand().'.'. $image->getClientOriginalExtension();
        $image->move(public_path('assets/admin/userImg/'), $image_name);


        $user->update([
            'location' => request()->get('location'),
            'bio' => request()->get('bio'),
            'latitude' => request()->get('latitude'),
            'longitude' => request()->get('longitude'),
            'user_id' => Auth::user()->id,
            'image' => ($image_name) ? $image_name : $currentImage
        ]);

        if ($user) {
            return response()->json(["status" => 1, "message" => 'Profile Updated Succesfully', "data" => $user]);
        }

    }

    public function signUp(Request $request){
        $rules=[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'phone'=>'required|min:11|max:17'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
        }
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json(["status" => 1, "message" => 'Account Created Successfully', "data" => []]);
    }

    public function signOut(Request $request)
    {
        $user = $request->user();

        $user->forceFill([
            'device_type' => null,
            'device_token' => null,
        ])->save();
        if ($user) {
            return response()->json(["status" => 1, "message" => 'Logout Successful', "data" => []]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $record = User::where('email', $request->email)->first();

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
        return response()->json(["status" => 0, "message" => 'Email Sent Succesfully', "data" => $record]);
    }

    public function changePassword(Request $request)
    {
        $user = User::find($request->user()->id);
        $password = $request->get('password');
        $new_password = $request->get('new_password');
        $confirm_password = $request->get('new_password_confirmation');

        $validator = Validator::make($request->all(), ['password' => 'required', 'new_password' => 'required|string|min:8|max:16|confirmed']);

        if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
        }
        if(Hash::check($password, $user->password)) {
            if($new_password == $confirm_password) {
                $user->password = bcrypt($new_password);
                $user->save();
                return response()->json(["status" => 1, "message" => 'Password Updated Successfully', "data" => []]);
            }
        }
        return response()->json(["status" => 0, "message" => 'please enter valid password', "data" => []]);
    }

    public function checkOtp(Request $request)
    {
        $email = $request->email;
        $otp = $request->otp;

        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users', 'otp' => 'required']);

        if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
        }

        if(!$otp || !$email) {
            return response()->json(["status" => 0, "message" => "Invalid Parameters", "data" => []]);
        }

        $user = User::where('otp', $otp)->where('email', $email)->first();

        if(!$user) {
            return response()->json(["status" => 0, "message" => "Please enter valid OTP", "data" => []]);
        }
        return response()->json(["status" => 1, "message" => 'OTP is valid', "data" => []]);
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;

        $validator = Validator::make($request->all(), ['otp' => 'required']);

        if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors(), "data" => []]);
        }

        if(!$otp) {
            return response()->json(["status" => 0, "message" => "Invalid Parameters", "data" => []]);
        }

        $user = User::where('otp', $otp)->first();
        $date = date('Y-m-d H:i:s');
        if ($user) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->otp = null;
            $user->save();
        }

        if(!$user) {
            return response()->json(["status" => 0, "message" => "Please enter valid OTP", "data" => []]);
        }
        return response()->json(["status" => 1, "message" => 'Email Verify Succesfully', "data" => []]);
    }
}
