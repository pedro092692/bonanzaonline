<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use Livewire\Component;
use App\Models\Product;
use App\Models\User;

class ProductShow extends Component
{
    public $product, $currency, $dollar_value;

    protected $listeners = ['currency_bs', 'currency_dollar'];

    public function mount(Product $product){
        $this->product = $product;
        $this->dollar_value = Currency::where('name', 'dollar')->latest()->first();
    }

    public function currency_bs(){
        $this->currency = 'bss';
    }


    public function currency_dollar(){
        $this->currency = 'dollar';
    }
    
    public function render()
    {
        return view('livewire.product-show');
    }
}
