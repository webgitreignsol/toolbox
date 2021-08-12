<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rides extends Model
{
    use LogsActivity;
    protected $table = 'rides';
    protected $fillable = ['shop_id', 'customer_id', 'rider_id', 'pick_up', 'accepted_at','cancell_at',
        'completed_at', 'cancell_by', 'cancel_reason', 'fare', 'status'];

    protected static $logName = 'Rides';
    protected static $logOnlyDirty = true;

    public function getAlltrips()
    {
        $trips = Rides::where('rider_id', \Auth::user()->id)->latest()->paginate(10);
        return $trips;
    }

    public function getScheduledtrips($request)
    {
        $trips = $this::where('rider_id', Auth::user()->id)->where('start_at', '>', now())->latest()->paginate(10);
        return $trips;
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function profile()
    {
        return $this->belongsTo('App\UserProfile', 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shops', 'shop_id');
    }

    public function riderDetail()
    {
        return $this->belongsTo('App\RiderDetail', 'rider_id');
    }

    public function rider()
    {
        return $this->belongsTo('App\User', 'rider_id');
    }

    public function cancell()
    {
        return $this->belongsTo('App\User', 'cancell_by');
    }
}
