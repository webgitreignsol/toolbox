<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = ['passenger_id', 'driver_id', 'drop_off', 'pick_up', 'time', 'type', 'fare', 'status'];


	public function passenger()
	{
		return $this->belongsTo('App\User', 'passenger_id');
	}


    public function driver()
    {
        return $this->belongsTo('App\User', 'driver_id');
    }

}
