<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Order extends Component
{
    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }


    public function order(){
        if(!Auth::check()){
            return $this->redirect(route('home'));
        }

        try{
            $product = Product::findOrFail($this->productId);

            Transaction::create([
                'product_id' => $this->productId,
                'user_id' => Auth::id(),
                'price' => $product->price,
                'quantity' => 1,
                'created_date' => now(),
            ]);

        }catch (\Exception $e) {
            session()->flash('error', 'Failed to add product to cart: ' . $e->getMessage());
        }
    }
    




    public function render()
    {
        return view('livewire.order');
    }
}
