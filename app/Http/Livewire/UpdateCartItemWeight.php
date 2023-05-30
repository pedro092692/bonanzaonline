<?php

namespace App\Http\Livewire;

use App\Models\Weight;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateCartItemWeight extends Component
{
    public $rowId, $qty, $quantity;

    public function mount(){
        $item = Cart::get($this->rowId);
        
        $this->qty = $item->qty;

        $weight =  Weight::where('name', $item->options->weight)->first();

        $this->quantity = qty_available($item->id, null, null, $weight->id);
    }

    public function decrement(){
        $this->qty -= 1;
        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }

    public function increment(){
        $this->qty += 1;
        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }
    
    public function render()
    {
        return view('livewire.update-cart-item-weight');
    }
}
