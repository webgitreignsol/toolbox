<?php
namespace App\Http\Resources\Frontend\Pets;
use Illuminate\Http\Resources\Json\JsonResource;

class View extends JsonResource
{
    public function toArray($request)
    {   
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'categoryId' => $this->category_id,
            'breedId' => $this->breed_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'age' => $this->age,
            'gender' => $this->gender,
            'avg_price' => $this->avg_price,
            'available_from' => $this->available_from,
            'available_to' => $this->available_to,
            'available_time_from' => $this->available_time_from,
            'available_time_to' => $this->available_time_to,
        ];
    }
}