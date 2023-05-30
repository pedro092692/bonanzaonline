<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Subcategory;

class Search extends Component
{

    public $search, $SearchSubcategories; 

    public $open = false;

    public function updatedSearch($value){
        if($value){
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function render()
    {
      
       if($this->search){

            $subcategories = Subcategory::where('name', 'LIKE', '%' . $this->search . '%')->take(3)->get();

            $products = Product::where('name', 'LIKE' , "%" . $this->search . "%")
            ->where('status', 1)
            ->take(8)
            ->get();
        }else{
            $products = [];
            $subcategories = [];
        }


        return view('livewire.search', compact('products', 'subcategories'));
    }
}
