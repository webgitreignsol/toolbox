<?php
namespace App\Http\Resources\Frontend\Trip\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;
class mytrip extends JsonResource
{
    public function toArray()
    {   
        return [
            'id'            => $this->id,
            "date"          => $this->date,
            "time"          => $this->time,
            "pickup"        => $this->pickup,
            "drop_off"      => $this->drop_off,
            "accepted_at"   => $this->accepted_at,
            "cancell_at"    => $this->cancell_at,
            "start_at"      => $this->start_at,
            "completed_at"  => $this->completed_at,
            "cancell_by"    => $this->cancell_by,
            "vehicle_type"  => $this->vehicle_type,
            "fare"          => $this->fare,
            "rider_id"     => $this->rider_id,
            "customer_id"  => $this->customer_id,
            "status"        => $this->status 
        ];
    }
}