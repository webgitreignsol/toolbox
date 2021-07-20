<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
	use LogsActivity;

    protected $fillable = ['user_id', 'address'];
    protected $table = 'address';

	public function user()
	{
	  	return $this->belongsTo('App\User', 'user_id');
	}

}
