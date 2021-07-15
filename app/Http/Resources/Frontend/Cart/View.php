<?php
namespace App\Http\Resources\Frontend\Cart;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Frontend\Pets\View as PetsDetail;

class View extends JsonResource
{
    public function toArray($request)
    {   
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'qty' => $this->qty,
            'price' => number_format($this->price ?? 0, 2),
            'total' => $this->total,
            'pet' => (new PetsDetail($this->pet))->resolve(),
        ];
    }
}