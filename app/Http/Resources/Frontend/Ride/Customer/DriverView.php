<?php
namespace App\Http\Resources\Frontend\Ride\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverView extends JsonResource
{
    public function toArray($request)
    {   
        return [
            'id'                        => $this->id,
            "driver_contact"            => $this->driver_contact,
            "driver_photo"              => $this->driver_photo,
            "car_photo"                 => $this->car_photo,
            "car_make"                  => $this->car_make,
            "car_registration_number"   => $this->car_registration_number,
            "fare"                      => $this->fare,
            "driver_id"                 => $this->driver_id       
        ];
    }
}