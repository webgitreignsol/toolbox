<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Rating;
use App\Trip;
use App\DriverDetail;
use App\Setting;
use Auth;
use DB;

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
}
