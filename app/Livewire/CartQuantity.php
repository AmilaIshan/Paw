<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CartQuantity extends Component
{
    public $item;
    public $quanitty;
    public $maxQuantity;

    public function mount($item)
    {
        $this->item = $item;
        $this->quanitty = $item->quantity;
        $this->maxQuantity = $item->product->quantity + $item->quantity;
    }

    public function increaseQuantity()
    {
        $product = Product::find($this->item->product_id);
        if($this->quanitty < $this->maxQuantity) {
            $this->quanitty++;
            $this->item->update(['quantity' => $this->quanitty]);
        }
        // $this->quanitty++;
        // $this->item->update(['quantity' => $this->quanitty]);
    }

    public function decreaseQuantity()
    {
        if ($this->quanitty > 1) {
            $this->quanitty--;
            $this->item->update(['quantity' => $this->quanitty]);
        }
    }



    public function render()
    {
        return view('livewire.cart-quantity');
    }
}
