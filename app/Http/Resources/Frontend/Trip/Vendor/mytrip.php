<?php
namespace App\Http\Resources\Frontend\Trip\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;
class mytrip extends JsonResource
{
    public function toArray($request)
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
            "type"          => $this->type,
            "vehicle_type"  => $this->vehicle_type,
            "fare"          => $this->fare,
            "driver_id"     => $this->driver_id,
            "passenger_id"  => $this->passenger_id,
            "status"        => $this->status 
        ];
    }
}