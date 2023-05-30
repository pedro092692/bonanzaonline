<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\User;

class Navigation extends Component
{
    public $currency, $currency_bs;


    public function currency(){
        $this->currency_bs = !$this->currency_bs;
        if($this->currency_bs){
            $this->emit('currency_bs');
        }else{
            $this->emit('currency_dollar');
        }
    }


    public function render()
    {
        $categories = Category::all();

        return view('livewire.navigation', compact('categories'));
    }
}
