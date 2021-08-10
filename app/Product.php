<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;
    protected $table = 'product';

    protected $fillable = ['name', 'category', 'image', 'price', 'description','user_id','shop_id'];

    protected static $logName = 'Product';
    protected static $logOnlyDirty = true;
}
