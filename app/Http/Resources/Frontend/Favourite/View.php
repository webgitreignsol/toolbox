<?php
namespace App\Http\Resources\Frontend\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Frontend\User\Details as UserDetails;
use App\Http\Resources\Frontend\Pets\View as PetDetails;

class View extends JsonResource
{
    public function toArray($request)
    {   
        return [
            'id' => $this->id,
            'user' => (new UserDetails($this->user))->resolve(),
            'pet' => (new PetDetails($this->pet))->resolve()
        ];
    }
}