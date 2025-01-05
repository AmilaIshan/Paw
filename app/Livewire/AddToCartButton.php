<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Laravel\Prompts\alert;

class AddToCartButton extends Component
{
    public function checkAuth(){
        if(Auth::check()){
            return $this->redirect(route('home'));
        }else{
            return $this->redirect(route('dashboard'));
        }
       
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
