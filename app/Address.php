<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use LogsActivity;
    protected $table = 'address';

    protected $fillable = ['address', 'user_id'];

    protected static $logName = 'Addresses';
    protected static $logOnlyDirty = true;
}
