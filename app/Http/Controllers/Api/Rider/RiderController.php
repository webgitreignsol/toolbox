<?php

namespace App\Http\Controllers\api\rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use App\Rides;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;

class RiderController extends Controller
{
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
        $records = Rides::with('shop' )->where('rider_id', Auth::user()->id)->where('status', 'accepted')->first();
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
