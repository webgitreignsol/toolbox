<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BankDetail extends Model
{
    use LogsActivity;
    protected $table = 'bankdetail';

    protected $fillable = ['name', 'bank_name','account_number','user_id'];

    protected static $logName = 'Bank Detail';
    protected static $logOnlyDirty = true;
}
