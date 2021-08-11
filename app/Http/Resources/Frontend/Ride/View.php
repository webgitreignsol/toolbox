<?php
namespace App\Http\Resources\Frontend\Story;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Frontend\User\Details as UserDetails;

class View extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'images' => $this->images ? $this->images : '',
            'description' => $this->description,
            'user' => (new UserDetails($this->user))->resolve(),
        ];
    }
}