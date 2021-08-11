<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductRating extends Model
{
    use LogsActivity;
    protected $table = 'product_rating';
    protected $fillable = [ 'product_id', 'reviewed_by', 'rating', 'comments'];
    protected static $logName = 'Product Rating';
    protected static $logOnlyDirty = true;
}
