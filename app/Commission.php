<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Commission extends Model
{
	use LogsActivity;
    protected $table = 'commission';
    protected $fillable = ['value', 'percent'];
}
