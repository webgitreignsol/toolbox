<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Shops extends Model
{
    use LogsActivity;
    protected $table = 'shops';

    protected $fillable = ['name', 'description','user_id','image','opening_hours'];

    protected static $logName = 'Shop';
    protected static $logOnlyDirty = true;

    protected $appends = ['ratings'];

    public function getRatingsAttribute($val) {
        $count = ShopRating::where('shop_id', $this->id)
            ->avg('rating');
        return $count ?? 0;
    }
}
