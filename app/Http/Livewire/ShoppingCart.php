<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Currency;

class ShoppingCart extends Component

{
    public $dollar_value;

    protected $listeners = ['render'];

    public function destroy(){
        Cart::destroy();
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobil', 'render');
    }

    public function delete($rowId){
        Cart::remove($rowId);
        
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobil', 'render');
    }

    public function render()
    {
        $dollar_value = $this->dollar_value = Currency::where('name', 'dollar')->latest()->first();
        return view('livewire.shopping-cart', compact('dollar_value'));
    }
}
