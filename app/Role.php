<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Activitylog\Traits\LogsActivity;


class Role extends \Spatie\Permission\Models\Role
{
	use LogsActivity;
    public $incrementing=false;
    protected $primaryKey='id';
    protected $guarded=[];
}
