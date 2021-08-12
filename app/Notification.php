<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Notification extends Model
{
    use LogsActivity;
    protected $table = 'notification';

    protected $fillable = ['order_id', 'customer_id','rider_id','title','content'];

    protected static $logName = 'Notification';
    protected static $logOnlyDirty = true;

    public function notificationListing()
    {
        $records = $this->listingNotification();

        $result = [];

        if (count($records) > 0)
        {
            $result = $records;
        }

        return $result;
    }

    public function listingNotification()
    {
        $records = $this::orderBy('created_at', 'desc')
            ->get();

        return $records;
    }
}
