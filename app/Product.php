<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;
    protected $table = 'product';

    protected $fillable = ['name', 'category', 'image', 'price', 'description','user_id','shop_id','qty'];

    protected static $logName = 'Product';
    protected static $logOnlyDirty = true;


    protected $appends = ['ratings'];

    public function getRatingsAttribute($val) {
        $count = ProductRating::where('product_id', $this->id)
            ->avg('rating');
        return $count ?? 0;
    }

    public function shops()
    {
        return $this->belongsTo('App\Shops', 'shop_id');
    }
}
