<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Currency;

class CategoryProducts extends Component
{
    public $category, $dollar_value;

    public $products = [];



    public function loadPosts(){
        $this->products = $this->category->products()->where('status', 1)->take(15)->get();
        
        $this->emit('glider', $this->category->id);
    }

    public function render()
    {
        $dollar_value = Currency::where('name', 'dollar')->latest()->first();
        
        $this->dollar_value = $dollar_value;
        
        return view('livewire.category-products', compact('dollar_value'));
    }
}
