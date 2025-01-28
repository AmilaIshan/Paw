<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $search = '';


    public function render()
    {

        $searchResults = [];

        if(strlen($this->search) >= 2){
            $searchResults = User::where('name', 'like', '%'.$this->search.'%')->limit(7)->get();
        }

        return view('livewire.search',[
            'users' => $searchResults
        ]);
    }
}
