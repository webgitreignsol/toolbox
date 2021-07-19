<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rating extends Model
{
	use LogsActivity;
    protected $fillable = ['ride_id', 'driver_id', 'passenger_id', 'rating', 'comments'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'driver_id ');
    }
    
    //  public function passneger()
    // {
    // 	return $this->belongsTo('App\User', 'passneger_id');
    // }

     public function rides()
    {
    	return $this->belongsTo('App\Ride', 'ride_id');
    }
}
	