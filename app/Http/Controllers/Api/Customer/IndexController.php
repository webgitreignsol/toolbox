<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rating;
use App\Trip;
use App\DriverDetail;
use Auth;

class IndexController extends Controller
{
    public function driverDetails(Request $request, $id)
   {
      $records['records'] = (new DriverDetail())->getDriverDetails($request, Auth::user()->id);
      return response()->json(["status" => 1, "message" => 'Driver Details', "data" => $records]);
   }

    public function getAlltrips(Request $request)
    {
      $data['records'] = (new Trip())->getCustomertrips($request);
      return response()->json(["status" => 1, "message" => 'Customer Trips  History', "data" => $data]);       
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
