<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ShopRating extends Model
{
    use LogsActivity;
    protected $table = 'shop_rating';
    protected $fillable = [ 'shop_id', 'reviewed_by', 'rating', 'comments'];
    protected static $logName = 'Shop Rating';
    protected static $logOnlyDirty = true;
}
