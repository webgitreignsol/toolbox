<?php
namespace App\Http\Resources\Frontend\Trip\Customer\mytrip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Frontend\Trip\Customer\mytrip as customertripDetails;

class mytrip extends JsonResource
{
    public function toArray($request)
    {   
        return [
            "id"            => $this->id,
            "date"          => $this->date,
            "time"          => $this->time,
            "pickup"        => $this->pickup,
            "drop_off"      => $this->drop_off,
            "vehicle_type"  => $this->vehicle_type,
            "fare"          => $this->fare,
            "driver_id"     => $this->driver_id,
            "passenger_id"  => $this->passenger_id,
            "status"        => $this->status           
        ];
    }
}