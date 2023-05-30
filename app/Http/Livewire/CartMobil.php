<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartMobil extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        
        return view('livewire.cart-mobil');
    }
}
