<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DriverSession extends Model
{
	use LogsActivity;
    protected $fillable = ['driver_id', 'start_time', 'end_time', 'status'];

    public function driver()
    {
    	return $this->belongsTo('App\User', 'driver_id');
    }
}
