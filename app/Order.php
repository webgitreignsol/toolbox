<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
	use LogsActivity;
	
   protected $fillabel = ['ride_id', 'passenger_id', 'driver_id', 'ride_fare', 'willgo_comm', 'texes', 'parent_id', 'type'];



	public function passenger()
	{
		return $this->belongsTo('App\User', 'passenger_id');
	}

	public function driver()
	{
		return $this->belongsTo('App\User', 'driver_id');
	}

	public function ride()
	{
		return $this->belongsTo('App\Ride', 'ride_id');
	}
}	