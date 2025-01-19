<?php

namespace App\Livewire;

use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class RemoveCartItem extends Component
{

    public $cartId;

    public function mount($cartId)
    {
        $this->cartId = $cartId;

    }

    public function confirmRemoveFromCart()
    {
        $this->dispatch('removeFromcart',
            title: 'error',
            message: 'Are you sure you want to remove this product from cart?',
            itemId: $this->cartId
        );
    }

    
    
    #[On('remove-from-cart')] 
    public function removeFromCart($itemId)
    {
        try{
            $controller = new CartController();
            $controller->destroy($itemId);
            $this->dispatch('cart-item-removed');
        }catch (\Exception $e){
            session()->flash('error', 'Failed to remove product from cart: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.remove-cart-item');
    }
}
