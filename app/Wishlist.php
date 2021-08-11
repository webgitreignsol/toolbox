<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Wishlist extends Model
{
    use LogsActivity;
    protected $table = 'wishlist';

    protected $fillable = ['user_id', 'product_id'];

    protected static $logName = 'WishList';
    protected static $logOnlyDirty = true;

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
