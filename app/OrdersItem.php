<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrdersItem extends Model
{
    use LogsActivity;
    protected $table = 'order_items';

    protected $fillable = ['order_id', 'product_id', 'qty','price','total'];

    protected static $logName = 'Order Item';
    protected static $logOnlyDirty = true;

    public function order()
    {
        return $this->belongsTo('App\Orders', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
