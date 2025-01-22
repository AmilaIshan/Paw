<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);

       return [
        'id' => $this->id,
        'name' => $this->product_name,
        'description' => $this->description,
        'price' => $this->price,
        'quantity' => $this->quantity,
        'weight' =>$this->weight,
        'category_name' =>$this->category->category_name,
        'image_url' => $this->image_url[0],
       ];
    }
}
