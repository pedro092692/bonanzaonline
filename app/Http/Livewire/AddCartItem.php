<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{

    public $product, $quantity;
    public $qty = 1;
    public $options = [
        'color_id' => null,
        'size_id' => null,
        'weight_id' => null       
    ];

    public function mount(){
        $this->quantity = qty_available($this->product->id);

        $image = Storage::url($this->product->images->first());
        
        if($image == "http://bonanzasonline.com/storage/"){
            $this->options['image'] = asset('images/no_available_image.png');
        }else{
            $this->options['image'] = Storage::url($this->product->images->first()->url);
        }
        
    }

    public function decrement(){
        $this->qty -= 1;
    }

    public function increment(){
        $this->qty += 1;
    }

    public function addItem(){
        Cart::add([ 'id' => $this->product->id, 
                    'name' => $this->product->name, 
                    'qty' => $this->qty, 
                    'price' => $this->product->price,
                    'options' => $this->options,
                    ]
                );
        
                $this->quantity = qty_available($this->product->id);

        $this->reset([
            'qty'
        ]);
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobil', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
