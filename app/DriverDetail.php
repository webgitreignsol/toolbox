<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
 use Illuminate\Contracts\Validation\Validator;
 use Illuminate\Http\Exceptions\HttpResponseException;
 use App\Http\Resources\Frontend\Ride\Customer\DriverView as ViewDriver;

class DriverDetail extends Model
{
	use LogsActivity;
    protected $fillable = ['driver_contact', 'driver_photo', 'car_photo', 'car_make','car_type', 'car_registration_number', 'driver_id'];

    public static $rules = ([
   			'driver_contact' 			    => 'required',
   			'driver_photo' 				    => 'required',
   			'car_photo' 				      => 'required',
            'car_make' 					      => 'required',
            'car_type' 					      => 'required',
   			'car_registration_number' => 'required'
   			]);

    public function getDriverDetails($request, $id)
   {
      $records = $this::where('id', $id)->first();
      return (new ViewDriver($records))->resolve();

   }

    public function driver()
    {
    	return $this->belongsTo('App\User', 'driver_id');
    }
}
