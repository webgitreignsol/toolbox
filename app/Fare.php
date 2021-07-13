<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    protected $fillable = ['per_mile', 'per_minute','willgo_commission'];
}
