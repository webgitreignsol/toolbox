<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Frontend\User\GetProfile as GetUserProfile;
use Laravel\Passport\HasApiTokens;
use Validator;
use App\User;
use App\UserProfile;
use Auth;

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

        if ($user) {
            return response()->json(["status" => 1, "message" => 'User Match Succesfully', "data" => $user]);
        } else {
            return response()->json(["status" => 0, "message" => 'Undefined User', "data" => []]);
        }

    }

    public function createProfile(Request $request)
    {
//        dd($request->all());
        $rules=[
            'location'   =>'required',
            'image'      => 'required|image',
            'bio'        => 'required'
        ];

        // $validator = Validator::make($request->all(), $rules);

        // if($validator->fails()) {
        //     return $validator;
        // }

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

    public function signUp(Request $request){
        $rules=[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'phone'=>'required|min:11|max:17'
        ];
        $this->validate($request,$rules);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json(["status" => 1, "message" => 'Account Created Successfully', "data" => []]);
    }
}
