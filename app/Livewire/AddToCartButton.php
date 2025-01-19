<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPSTORM_META\type;

class AddToCartButton extends Component
{
    public $productId;
    public $isInCart = false;
    
    public function mount($productId)
    {
        $this->productId = $productId;
        $this->checkIfInCart();

    }
    
    public function checkAuth()
    {
        
        if (!Auth::check()) {
           $this->dispatch('guest',
                type: "error",
                message : "You need to login to add product to cart"
            );
        }else{

            $this->dispatch('add-to-cart',
                title: 'success',
                message: 'Product added to cart successfully!'
            );
            try {
                $product = Product::findOrFail($this->productId);
                
                // Create cart entry directly instead of making HTTP request
                $cart = Cart::create([
                    'product_id' => $this->productId,
                    'user_id' => Auth::id(),
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
    
                if ($cart) {
                    session()->flash('message', 'Product added to cart successfully!');
                    $this->dispatch('cart-updated'); // Optional: Dispatch event to update cart counter if needed
                }
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to add product to cart: ' . $e->getMessage());
            }
        }

      
    }

    public function checkIfInCart()
    {
        if (Auth::check()) {
            $this->isInCart = Cart::where('user_id', Auth::id())
                                 ->where('product_id', $this->productId)
                                 ->exists();
        }
    }


    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}