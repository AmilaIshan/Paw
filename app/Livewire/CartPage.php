<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class CartPage extends Component
{

    public $cartItems;
    public $totalCost;

    public function mount()
    {
        $this->loadCartItems();
    }

    #[On('cart-item-removed')]
    public function loadCartItems()
    {
        // Get authenticated user's cart items with product details
        $this->cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        // Calculate total cost
        $this->totalCost = $this->cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }

    public function removeItem($cartId)
    {
        // Remove the item from the cart
        Cart::where('id', $cartId)->delete();

        // Reload the cart items and recalculate the total cost
        $this->loadCartItems();

        session()->flash('message', 'Product removed from cart');
    }


    public function render()
    {
        return view('livewire.cart-page');
    }
}
