<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverSession extends Model
{
    protected $fillable = ['driver_id', 'start_time', 'end_time', 'status'];

    public function driver()
    {
    	return $this->belongsTo('App\User', 'driver_id');
    }
}
