<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Ride extends Model
{
	use LogsActivity;
	
	protected $appends = ['fares'];
    protected $fillable = ['passenger_id', 'driver_id', 'drop_off', 'pick_up', 'accepted_at', 'start_at',  'cancel_at', 'completed_at', 'type', 'fare', 'status'];


    public function getFaresAttribute($val) {
        $fare = Fare::first();
        return $fare;
    }

	public function passenger()
	{
		return $this->belongsTo('App\User', 'passenger_id');
	}

	public function Profile()
	{
		return $this->belongsTo('App\UserProfile', 'passenger_id');
	}

    public function driver()
    {
        return $this->belongsTo('App\User', 'driver_id');
    }

   

}
