<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'ride_id', 'amount', 'card', 'payment_method', 'status'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function ride()
    {
    	return $this->belongsTo('App\Ride', 'ride_id');
    }
}
