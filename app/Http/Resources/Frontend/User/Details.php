<?php
namespace App\Http\Resources\Frontend\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Details extends JsonResource
{
    public function toArray($request)
    {   
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}