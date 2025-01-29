<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id' => $this->id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'product_name' => $this->product->product_name,
            'stock_quantity' => $this->product->quantity,
            'image_url' => $this->product->image_url[0],
            'product_id' => $this->product_id
        ];
    }
}
