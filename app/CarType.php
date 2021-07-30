<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CarType extends Model
{
	use LogsActivity;
    protected $table = 'car_type';

    protected $fillable = ['name','capacity', 'description'];

}
