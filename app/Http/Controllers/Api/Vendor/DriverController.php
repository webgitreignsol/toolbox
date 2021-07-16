<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DriverDetail;
use Validator;
use Auth;
class DriverController extends Controller
{
   public function index()
   {	
   		$records = DriverDetail::latest()->paginate();
        return response()->json(["status" => 1, "message" => 'Driver Details', "data" => $records]);       
   }

   public function store(Request $request)
   {	
   		$drimage = $request->file('driver_photo');
   		$crimage = $request->file('car_photo');	

   		$dr_img = rand().'.'. $drimage->getClientOriginalExtension();
   		$drimage->move(public_path('assets/admin/driverImg'), $dr_img);

   		$cr_img = rand().'.'. $crimage->getClientOriginalExtension();
   		$crimage->move(public_path('assets/admin/carImg'), $cr_img);

   		$auth_id = Auth::user()->id;

   		$arr = array(
   			'driver_contact' 			=> $request->driver_contact,
   			'driver_photo' 				=> $dr_img,
   			'car_photo' 				=> $cr_img,
   			'car_make' 					=> $request->car_make,
   			'car_registration_number' 	=> $request->car_registration_number,
   			'driver_id' 				=> Auth::user()->id
   			);
   		 $validator = Validator::make($arr, DriverDetail::$rules);
        
        if ($validator->fails()) {
    
          return response()->json(['errors'=>$validator->errors()]);
        }else{
        	DriverDetail::where('driver_id', $auth_id)->update($arr);

        	return response()->json([
            'message' => 'Success',
            'status' => 1,
            'data' => $arr
        ]);  
        }
   }

   public function update(Request $request)
   {
   		$drimage = $request->file('driver_photo');
   		$crimage = $request->file('car_photo');	

   		$dr_img = rand().'.'. $drimage->getClientOriginalExtension();
   		$drimage->move(public_path('assets/admin/driverImg'), $dr_img);

   		$cr_img = rand().'.'. $crimage->getClientOriginalExtension();
   		$crimage->move(public_path('assets/admin/carImg'), $cr_img);

   		$auth_id = Auth::user()->id;   		

   		$arr = array(
   			'driver_contact' 			=> $request->driver_contact,
   			'driver_photo' 				=> $dr_img,
   			'car_photo' 				=> $cr_img,
   			'car_make' 					=> $request->car_make,
   			'car_registration_number' 	=> $request->car_registration_number,
   			'driver_id' 				=> $auth_id
   			);

   		 $validator = Validator::make($arr, DriverDetail::$rules);
        
        if ($validator->fails()) {
    
          return response()->json(['errors'=>$validator->errors()]);
        }else{
        	DriverDetail::where('driver_id', $auth_id)->update($arr);

        	return response()->json([
            'message' => 'Success',
            'status' => 1,
            'data' => $arr
        ]);  
        }
        
   }
}
