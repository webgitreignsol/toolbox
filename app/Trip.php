<?php

namespace App;

use App\Rides;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Auth;
use Carbon\Carbon;
use DB;
class Trip extends Model
{
    use LogsActivity;

    protected $fillable = ['date', 'time', 'pickup', 'drop_off', 'vehicle_type','ride_type', 'fare', 'rider_id', 'customer_id', 'status'];

    public function getAlltrips()
    {
        $trips = Rides::where('rider_id', \Auth::user()->id)->latest()->paginate(10);
        return $trips;
    }

    public function getCustomertrips($request)
    {
        $trips = Trip::where('customer_id', \Auth::user()->id)->latest()->paginate(10);
        return $trips;
    }
}
