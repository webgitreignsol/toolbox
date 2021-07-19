<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rating;
use App\Trip;
use Auth;
class IndexController extends Controller
{
    public function getAlltrips()
    {
    	$trips = Trip::where('passneger_id', Auth::user()->id)->latest()->paginate(10);
    	return response()->json(["status" => 1, "message" => 'Customer Trips', "data" => $trips]);       
    }

    public function ratings(Request $request)
    {
        $arr = array(
            'driver_id'         => $request->driver_id,
            'ride_id'           => $request->ride_id,
            'passenger_id'      => Auth::user()->id,
            'rating'            => $request->rating,
            'comments'          => $request->comments
        );

        Rating::create($arr);

        return response()->json([
            'message'           => 'Success',
            'status'            => 1,
            'data'              => $arr
        ]);
    }
}
