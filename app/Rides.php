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

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shops', 'shop_id');
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
