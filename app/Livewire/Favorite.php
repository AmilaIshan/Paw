<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\favorite as ModelsFavorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Favorite extends Component
{

    public $productId;
    public $hasLiked = false;


    public function mount($productId)
    {

        $this->productId = $productId;
        $this->checkFavoriteStatus();
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $hasLiked = $user->favoriteProducts()->where('product_id', $this->productId)->exists();

        if ($hasLiked) {
            $user->favoriteProducts()->detach($this->productId);
            $this->hasLiked = false;
            return;
        } else {
            $user->favoriteProducts()->attach($this->productId);
            $this->hasLiked = true;
            return;
        }
    }

    public function checkFavoriteStatus()
    {
        if (Auth::check()) {
            $this->hasLiked = Auth::user()->favoriteProducts()
                ->where('product_id', $this->productId)
                ->exists();
        }
    }




    public function render()
    {
        return view('livewire.favorite');
    }
}
