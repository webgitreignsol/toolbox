<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = ['passenger_id', 'driver_id', 'drop_off', 'pick_up', 'time', 'type', 'fare', 'status'];


	public function user()
	{
		return $this->belongsTo('App\User', 'passenger_id');
	}

}	