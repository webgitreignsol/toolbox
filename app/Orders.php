<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Orders extends Model
{
    use LogsActivity;
    protected $table = 'orders';

    protected $fillable = ['order_id', 'order_date', 'rider_id','customer_id','accept_reject_order','status','user_id','sub_total','vat','grand_total','paid_amount','tip','delivery_charges'];

    protected static $logName = 'Order';
    protected static $logOnlyDirty = true;

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function rider()
    {
        return $this->belongsTo('App\User', 'rider_id');
    }
}
