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
      $driver = DriverDetail::where('driver_id', $auth_id)->first();
   		$arr = array(
     			'driver_contact' 			   => $request->driver_contact,
     			'driver_photo' 				   => $dr_img,
     			'car_photo' 				     => $cr_img,
     			'car_make' 					     => $request->car_make,
     			'car_registration_number'=> $request->car_registration_number,
     			'driver_id' 				     => Auth::user()->id
   			);

      if ($driver == null) {      
        DriverDetail::create($arr);      
      }else{
        DriverDetail::where('driver_id', $auth_id)->update($arr);        
      }
      	return response()->json([
          'message'     => 'Success',
          'status'      => 1,
          'data'        => $arr
        ]);
    }

    public function getAlltrips(Request $request)
    {
      $data['records'] = (new Trip())->getAlltrips($request);
      return response()->json(["status" => 1, "message" => 'Driver Trips  History', "data" => $data]);
    }

    public function getScheduledtrips(Request $request)
    {
      $data['records'] = (new Ride())->getScheduledtrips($request);
      return response()->json(["status" => 1, "message" => 'Driver Trips  History', "data" => $data]);
    }

    public function TripReq($id)
    {
      $trip = Ride::with('passenger', 'profile' )->where('id', $id)->first();
      return response()->json(["status" => 1, "message" => 'Trip Request', "data" => $trip]);
    }

    public function rideStatus(Request $request,$id)
    {
        $ride = Ride::find($id);
        $validator = Validator::make($request->all(), ['status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors()]);
        }
        $status = $request->status;
        if ($status == 'accepted') {
            $ride->status = $status;
            $ride->accepted_at = date('Y-m-d H:i:s');
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Accepted', "data" => $ride]);
        } elseif ($status == 'started'){
            $ride->status = $status;
            $ride->start_at = date('Y-m-d H:i:s');
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Started', "data" => $ride]);
        }elseif ($status == 'completed'){
            $ride->status = $status;
            $ride->completed_at = date('Y-m-d H:i:s');
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Completed', "data" => $ride]);
        }elseif ($status == 'cancelled'){
            $ride->status = $status;
            $ride->cancell_by = Auth::user()->id;
            $ride->cancell_at = date('Y-m-d H:i:s');
            $ride->remarks =$request->remarks;
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Cancelled', "data" => $ride]);
        }
    }
}