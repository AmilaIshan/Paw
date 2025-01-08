<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CartCost extends Component
{
    public $totalCost = 0;

    #[On('cartUpdated')]
    public function updateTotalCost()
    {
        $this->totalCost = Cart::where('user_id', Auth::id())
            ->get()
            ->sum(function($item) {
                return $item->price * $item->quantity;
            });
    }

    public function mount()
    {
        $this->updateTotalCost();
    }

    public function render()
    {
        return view('livewire.cart-cost', [
            'totalCost' => $this->totalCost
        ]);
    }
}
