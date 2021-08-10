<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rating extends Model
{
    use LogsActivity;
    protected $table = 'rating';
    protected $fillable = ['ride_id', 'get_review', 'reviewed_by', 'rating', 'comments'];

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id ');
    }

    public function rider()
    {
        return $this->belongsTo('App\User', 'rider_id');
    }

    public function rides()
    {
        return $this->belongsTo('App\Rides', 'ride_id');
    }

}
