<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;

class RecommendedProducts extends Component
{
    public $products;

    public function mount(){
        $this->products = ProductModel::take(12)->get();
    }



    public function render()
    {
        return view('livewire.recommended-products');
    }
}
