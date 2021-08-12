<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RiderDetail extends Model
{
    use LogsActivity;
    protected $table = 'rider_detail';
    protected $fillable = ['rider_contact', 'rider_photo', 'vehicle_photo', 'vehicle_make', 'vehicle_registration_number', 'rider_id'];

    public static $rules = ([
        'rider_contact' 			    => 'required',
        'rider_photo' 				    => 'required',
        'vehicle_photo' 				      => 'required',
        'vehicle_make' 					      => 'required',
        'vehicle_registration_number' => 'required'
    ]);
}
