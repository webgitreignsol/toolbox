<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\DriverDetail;
use Validator;
use App\Setting;
use App\Ride;
use App\Trip;
use Auth;
use DB;



class DriverController extends Controller
{
  use ApiResponse;   

   public function store(Request $request)
   {
    $validator = Validator::make($request->all(), DriverDetail::$rules);

      if ($validator->fails()) {

          return response()->json(['errors'=>$validator->errors()]);
      }

      $drimage = $request->file('driver_photo');
   		$crimage = $request->file('car_photo');

   		$dr_img = rand().'.'. $drimage->getClientOriginalExtension();
   		$drimage->move(public_path('assets/admin/driverImg'), $dr_img);

   		$cr_img = rand().'.'. $crimage->getClientOriginalExtension();
   		$crimage->move(public_path('assets/admin/carImg'), $cr_img);

   		$auth_id = Auth::user()->id;

   		$arr = array(
     			'driver_contact' 			   => $request->driver_contact,
     			'driver_photo' 				   => $dr_img,
     			'car_photo' 				     => $cr_img,
     			'car_make' 					     => $request->car_make,
     			'car_registration_number'=> $request->car_registration_number,
     			'driver_id' 				     => Auth::user()->id
   			);

      	DriverDetail::where('driver_id', $auth_id)->update($arr);

      	return response()->json([
          'message'     => 'Success',
          'status'      => 1,
          'data'        => $arr
        ]);
   }

   public function update(Request $request)
   {
      if ($validator->fails()) {

          return response()->json(['errors'=>$validator->errors()]);
      }

   		$drimage = $request->file('driver_photo');
   		$crimage = $request->file('car_photo');

   		$dr_img = rand().'.'. $drimage->getClientOriginalExtension();
   		$drimage->move(public_path('assets/admin/driverImg'), $dr_img);

   		$cr_img = rand().'.'. $crimage->getClientOriginalExtension();
   		$crimage->move(public_path('assets/admin/carImg'), $cr_img);

   		$auth_id = Auth::user()->id;

   		$arr = array(
     			'driver_contact' 			    => $request->driver_contact,
     			'driver_photo' 				    => $dr_img,
     			'car_photo' 				      => $cr_img,
     			'car_make' 					      => $request->car_make,
     			'car_registration_number' => $request->car_registration_number,
     			'driver_id' 				      => $auth_id
   			);

      	DriverDetail::where('driver_id', $auth_id)->update($arr);

      	return response()->json([
          'message'       => 'Success',
          'status'        => 1,
          'data'          => $arr
        ]);
      }

    public function getDriversAroud(Request $request)
    {
      $lat = $request->get('latitude');
      $lon = $request->get('longitude');
      $limit = $request->get('limit');
      $offset = $request->get('offset');
      // if($lat && $lon) {
          $distance = Setting::pluck('distance');

          $records = DB::table('user_profiles')
            ->join('users', 'user_profiles.user_id', 'users.id')
            ->join('driver_details', 'user_profiles.user_id', 'driver_details.driver_id')
            ->select("user_profiles.*", "users.*", "driver_details.*"
                ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
                * cos(radians(latitude))
                * cos(radians(longitude) - radians(" . $lon . "))
                + sin(radians(" .$lat. "))
                * sin(radians(latitude))) AS distance"))
                ->where("driver_details.car_photo", $request->car_photo)
                ->having("distance", "<" , $distance);

            if ($limit || $offset) {
                $records = $records->orderby('distance', 'asc')->skip($offset)->take($limit);
            } else {
                $records = $records->orderby('distance', 'asc');
            }

            $records = $records->get();
            // dd($request->car_photo);
            if(count($records) > 0) {
            return response()->json([
              'message'   => 'Success',
              'status'  => 1,
              'data'    => $records // new \stdClass()
            ]);
          }else{
            return response()->json([
              'message'   => 'No record Found',
              'status'  => 0,
              'data'    => $records // new \stdClass()
            ]);
          }          
    }

    public function getAlltrips(Request $request)
    {
      $data['records'] = (new Trip())->getAlltrips($request);
      return response()->json(["status" => 1, "message" => 'Driver Trips  History', "data" => $data]);
    }

    public function TripReq($id)
    {
      $trip = Ride::with('passenger', 'profile' )->where('id', $id)->first();
      return response()->json(["status" => 1, "message" => 'Trip Request', "data" => $trip]);
    }
}
