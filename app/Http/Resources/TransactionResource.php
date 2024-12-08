<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id' =>$this->id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'user_name' => $this->user->name,
            'product_name' => $this->product->product_name
        ];
    }
}
