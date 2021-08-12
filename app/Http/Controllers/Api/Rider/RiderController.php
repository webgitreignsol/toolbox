<?php

namespace App\Http\Controllers\api\rider;

use App\Http\Controllers\Controller;
use App\RiderDetail;
use Illuminate\Http\Request;
use App\Trip;
use App\Rides;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;

class RiderController extends Controller
{
    public function riderDetail(Request $request)
    {
        $validator = Validator::make($request->all(), RiderDetail::$rules);

        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()]);
        }

        $drimage = $request->file('rider_photo');
        $crimage = $request->file('vehicle_photo');

        $dr_img = rand().'.'. $drimage->getClientOriginalExtension();
        $drimage->move(public_path('assets/admin/riderImg'), $dr_img);

        $cr_img = rand().'.'. $crimage->getClientOriginalExtension();
        $crimage->move(public_path('assets/admin/carImg'), $cr_img);

        $auth_id = Auth::user()->id;
        $driver = RiderDetail::where('rider_id', $auth_id)->first();
        $arr = array(
            'rider_contact' 			   => $request->rider_contact,
            'rider_photo' 				   => $dr_img,
            'vehicle_photo' 				     => $cr_img,
            'vehicle_make' 					     => $request->vehicle_make,
            'vehicle_registration_number'=> $request->vehicle_registration_number,
            'rider_id' 				     => Auth::user()->id
        );

        if ($driver == null) {
            RiderDetail::create($arr);
        }else{
            RiderDetail::where('rider_id', $auth_id)->update($arr);
        }
        return response()->json([
            'message'     => 'Success',
            'status'      => 1,
            'data'        => $arr
        ]);
    }

    public function getAlltrips()
    {
        $records = Rides::with('customer' )->orderBy('created_at', 'desc')->where('rider_id', Auth::user()->id)->get();

        if (!$records) {
            return response()->json(["status" => 0, "message" => 'Your Trips History Is Empty', "data" => []]);
        }else{
            return response()->json(["status" => 1, "message" => 'Rider Trips  History', "data" => $records]);
        }
    }

    public function getScheduledtrips()
    {
        $records = Rides::with('customer' )->where('rider_id', Auth::user()->id)->where('start_at', '>', now())->get();
        if (!$records) {
            return response()->json(["status" => 0, "message" => 'Your Scheduled Trips Is Empty', "data" => []]);
        }
        return response()->json(["status" => 1, "message" => 'Rider Trips  History', "data" => $records]);
    }


    public function RideAccepted()
    {
        $records = Rides::with('shop' ,'riderDetail' )->where('rider_id', Auth::user()->id)->where('status', 'accepted')->first();
        if (!$records) {
            return response()->json(["status" => 0, "message" => 'Undefined Ride', "data" => []]);
        }
        return response()->json(["status" => 1, "message" => 'Ride Information', "data" => $records]);
    }

    public function rideStatus(Request $request,$id)
    {
        $ride = Rides::find($id);
        $validator = Validator::make($request->all(), ['status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors()]);
        }
        $status = $request->status;
        if ($status == 'accepted') {
            $ride->status = $status;
            $ride->accepted_at = date('H:i:s');
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Accepted', "data" => $ride]);
        } elseif ($status == 'started'){
            $ride->status = $status;
            $ride->start_at = date('H:i:s');
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Started', "data" => $ride]);
        }elseif ($status == 'completed'){
            $ride->status = $status;
            $ride->completed_at = date('H:i:s');
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Completed', "data" => $ride]);
        }elseif ($status == 'cancelled'){
            $ride->status = $status;
            $ride->cancell_by = Auth::user()->id;
            $ride->cancell_at = date('H:i:s');
            $ride->cancel_reason =$request->cancel_reason;
            $ride->save();
            return response()->json(["status" => 1, "message" => 'Ride Cancelled', "data" => $ride]);
        }
    }
}
