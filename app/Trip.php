<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Http\Resources\Frontend\Trip\Customer\mytrip as customertripDetails;
use App\Http\Resources\Frontend\Trip\Vendor\mytrip as drivertripDetails;


class Trip extends Model
{
	use LogsActivity;

    protected $fillable = ['date', 'time', 'pickup', 'drop_off', 'vehicle_type','ride_type', 'fare', 'driver_id', 'passenger_id', 'status'];

    public function getAlltrips($request)
    {
      $trips = Trip::where('driver_id', \Auth::user()->id)->latest()->paginate(10);
      $result = drivertripDetails::collection($trips)->toArray($request);
      return $result;
    }

    public function getCustomertrips($request)
    {
      $trips = Trip::where('passenger_id', \Auth::user()->id)->latest()->paginate(10);
      $result = drivertripDetails::collection($trips)->toArray($request);
      return $result;
    }

    public function driver()
    {
    	return $this->belongsTo('App\User', 'driver_id');
    }

     public function passenger()
    {
    	return $this->belongsTo('App\User', 'passenger_id');
    }
}