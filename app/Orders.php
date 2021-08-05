<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Orders extends Model
{
    use LogsActivity;
    protected $table = 'orders';

    protected $fillable = ['order_id', 'order_date', 'product_name', 'rider_name', 'rider_contact','product_price','customer_name','accept_reject_order','status'];

    protected static $logName = 'Order';
    protected static $logOnlyDirty = true;
}
