<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category as CategoryModel;

class Category extends Component
{

    public $categories;

    public function mount(){
        $this->categories = CategoryModel::all();
    }

    public function render()
    {
        return view('livewire.category');
    }
}
