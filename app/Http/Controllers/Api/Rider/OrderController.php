<?php

namespace App\Http\Controllers\api\rider;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use Validator;
use App\User;
use App\UserProfile;
use Auth;
use Carbon\Carbon;
use App\Orders;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function riderEarning(Request $request)
    {
        $orders = Orders::where('status','Order Delivered')->where('rider_id',Auth::user()->id)->get();
        $sum = Orders::where('status','Order Delivered')->where('rider_id',Auth::user()->id)->select('rider_id', DB::raw('SUM(delivery_charges) as charges'))
            ->groupBy('rider_id')
            ->get();
        return response()->json(["status" => 1, "message" => 'Your Earning', "data" => [$orders,$sum]]);
    }


    public function search(Request $request)
    {
        $fromDate = date('Y-m-d 00:00:00', strtotime($request->from_date));
        $toDate = date('Y-m-d 23:59:59', strtotime(date('Y-m-d')));
        $sum = Orders::whereBetween('created_at', array($fromDate, $toDate))
            ->where('status','Order Delivered')
            ->where('rider_id',Auth::user()->id)
            ->select('rider_id', DB::raw('SUM(delivery_charges) as charges'))
            ->groupBy('rider_id')
            ->get();
        return response()->json(["status" => 1, "message" => 'Your Earning', "data" => $sum]);

    }
}
