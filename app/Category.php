<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    protected $table = 'category';

    protected $fillable = ['name', 'description','user_id'];

    protected static $logName = 'Category';
    protected static $logOnlyDirty = true;
}
