<?php

namespace App\Http\Controllers\api\rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Frontend\User\GetProfile as GetUserProfile;
use Laravel\Passport\HasApiTokens;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Classes\Helper;
use Validator;
use App\User;
use App\UserProfile;
use Auth;
use Carbon\Carbon;
use App\Rating;
use DB;


class AuthController extends Controller
{

    use ApiResponse;
    use HasApiTokens;

    public function login(Request $request)
    {
        try
        {
            $record = new User();
            $record = $record->login($request);

            if (!$record instanceof User)
            {
                if (gettype($record) == 'string')
                {
                    return $this->apiErrorMessageResponse($record, []);
                }
                else
                {
                    return $this->apiValidatorErrorResponse('Invalid Parameters', $record->errors());
                }
            }
            else
            {
                return $this->apiSuccessMessageResponse('You hav\'n sign in successfully', $record);
            }
        }
        catch (Exception $e)
        {
            return $this->apiErrorMessageResponse($e->getMessage(), []);
        }
    }

    public function getProfile(Request $request)
    {
        $user = User::with('user_profiles')->where('id', Auth::user()->id)->first();

        if ($user) {
            return response()->json(["status" => 1, "message" => 'User Match Succesfully', "data" => [$user]]);
        } else {
            return response()->json(["status" => 0, "message" => 'Undefined User', "data" => []]);
        }

    }

    public function signOut(Request $request)
    {
        try
        {
            $record = new User();
            $record = $record->signOut($request);

            if (!$record instanceof User)
            {
                if (gettype($record) == 'string')
                {
                    return $this->apiErrorMessageResponse($record, []);
                }
                else
                {
                    return $this->apiValidatorErrorResponse('Invalid Parameters', $record->errors());
                }
            }
            else
            {
                return $this->apiSuccessMessageResponse('Logout Successfully');
            }
        }
        catch (Exception $e)
        {
            return $this->apiErrorMessageResponse($e->getMessage(), []);
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

    public function updatePassword(Request $request)
    {
        $new_password = $request->get('new_password');
        $confirm_password = $request->get('new_password_confirmation');
        $email = $request->get('email');
        $otp = $request->get('otp');

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|max:16|confirmed',
            'email' => 'required|email|exists:users',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiErrorMessageResponse($validator->errors());
        }

        $User = User::where('otp', $otp)->where('email', $email)->first();

        if(!$User) {
            return $this->apiErrorMessageResponse("Please enter valid OTP");
        }
        if($new_password == $confirm_password) {
            $User->password = bcrypt($new_password);
            $User->otp = null;
            $User->save();
        } else {
            return $this->apiErrorMessageResponse("New Password And Confirm Does Not Match");
        }
        return $this->apiSuccessMessageResponse('Password updated successfully');
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

    public function resendOtp(Request $request)
    {
        $user = new User();
        $user = $user->resendOtp($request);

        if( $user instanceof \App\User ) {

            $message = "The Otp Code has been sent to your registered email";

            return $this->apiSuccessMessageResponse($message);
        }

        if(gettype($user) == 'string') {
            return $this->apiErrorMessageResponse($user, []);
        } else {
            return $this->apiValidatorErrorResponse('Invalid Parameters', $user->errors());
        }
    }

    public function updateProfile(Request $request)
    {
        $record = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiValidatorErrorResponse('Invalid Parameters', $validator->errors());
        }
        if ($request->hasFile('license_front_img')) {
        $image = $request->file('license_front_img');
        $image_names = rand().'.'. $image->getClientOriginalExtension();
        $image->move(public_path('assets/admin/img/userlicenses/'), $image_names);
        } elseif($record->license_front_img) {
            $image_names = $record->license_front_img;
        } else {
            $image_names = null;
        }
        if ($request->hasFile('license_back_img')) {
        $backImage = $request->file('license_back_img');
        $backimage_name = rand().'.'. $backImage->getClientOriginalExtension();
        $backImage->move(public_path('assets/admin/img/userlicenses/'), $backimage_name);
        } elseif($record->license_back_img) {
            $backimage_name = $record->license_back_img;
        } else {
            $backimage_name = null;
        }

        $record->name = $request->name;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->license_front_img = $image_names;
        $record->license_back_img	 = $backimage_name;
        $record->save();

        if ($record) {
            $userProfile = UserProfile::where('user_id', $record->id)->first();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = rand().'.'. $image->getClientOriginalExtension();
                $image->move(public_path('assets/admin/img/userlicenses/'), $image_name);
            } elseif($userProfile->image) {
                $image_name = $userProfile->image;
            } else {
                $image_name = null;
            }

            $userProfile = UserProfile::where('user_id', $record->id)->first();
            if ($userProfile) {
                $userProfile->location = $request->location;
                $userProfile->image = $image_name;
                $userProfile->save();
            } else {
                $userProfile = new UserProfile();
                $userProfile->location = $request->location;
                $userProfile->image = $image_name;
                $userProfile->user_id = Auth::user()->id;
                $userProfile->save();
            }
        }
        return response()->json(["status" => 0, "message" => "Profile Updated SuccessFully", "data" => $record]);
    }

    public function signUp(Request $request)
    {
        $validationRules['name'] = 'required|string|min:3|max:55';
        $validationRules['password'] = 'required|string|min:8|max:16|confirmed';
        $validationRules['verified_by'] = 'required|in:email';
        $validationRules['email'] = 'required|string|email|min:5|max:155|unique:users';
        $validationRules['zip_code'] = 'required|numeric';
        $validationRules['state'] = 'required';
        $validationRules['city'] = 'required';
        $validationRules['address'] = 'required';
        $validationRules['license_front_img'] = 'required|image';
        $validationRules['license_back_img'] = 'required|image';
        $validationRules['phone'] = 'required|numeric|digits_between:9,14|unique:users';

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $this->apiValidatorErrorResponse('Invalid Parameters', $validator->errors());
        }

        if ($request->verified_by == 'email') {
            $type = 'email';
            $token = mt_rand(1000, 9999);
        }

        $image = $request->file('license_front_img');
        $image_name = rand().'.'. $image->getClientOriginalExtension();
        $image->move(public_path('assets/admin/img/userlicenses/'), $image_name);

        $backImage = $request->file('license_back_img');
        $backimage_name = rand().'.'. $backImage->getClientOriginalExtension();
        $backImage->move(public_path('assets/admin/img/userlicenses/'), $backimage_name);

        if ($request->password == $request->password_confirmation) {


            $user = new User();
                $user->name = $request->name;
                $user->email  = $request->email;
                $user->zip_code = $request->country_code;
                $user->address = $request->address;
                $user->state = $request->state;
                $user->city = $request->city;
                $user->phone = $request->phone;
                $user->password = bcrypt($request->password);
                $user->verified_by = $type;
                $user->otp = $token;
                $user->license_front_img = $image_name;
                $user->license_back_img = $backimage_name;
            $user->save();

            if ($user->verified_by == 'email') {
                $data = [
                    'email' => $user->email,
                    'name' => $user->name,
                    'subject' => 'Account verification code',
                ];

                Helper::sendEmail('accountVerification', ['data' => $user], $data);
            }
            return $this->apiSuccessMessageResponse($user);
        } else {
            $message = "The Password Confirmation Does Not Match";

            return $this->apiErrorMessageResponse($message);
        }

    }
}
