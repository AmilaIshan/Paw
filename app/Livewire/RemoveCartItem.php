<?php

namespace App\Livewire;

use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RemoveCartItem extends Component
{

    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;

    }

    public function removeFromCart()
    {
        try{
            $controller = new CartController();
            $controller->destroy($this->productId);
            $this->dispatch('cart-updated');
        }catch (\Exception $e){
            session()->flash('error', 'Failed to remove product from cart: ' . $e->getMessage());
        }
        
    }



    public function render()
    {
        return view('livewire.remove-cart-item');
    }
}
