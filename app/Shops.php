<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Shops extends Model
{
    use LogsActivity;
    protected $table = 'shops';

    protected $fillable = ['name', 'description','user_id'];

    protected static $logName = 'Shop';
    protected static $logOnlyDirty = true;
}
