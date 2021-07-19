<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Trip;

class Trip extends Model
{
	use LogsActivity;

    protected $fillable = ['date', 'time', 'pickup', 'drop_off', 'vehicle_type', 'fare', 'driver_id', 'passneger_id', 'status'];


    public function driver()
    {
    	return $this->belongsTo('App\User', 'driver_id');
    }

     public function passneger()
    {
    	return $this->belongsTo('App\User', 'passneger_id');
    }

}