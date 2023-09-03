<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemWeight extends Component
{

    public $product, $weights, $qty = 1, $quantity = 0, $weight_id = ""; 
    public $factor = 1;
    public $options = [
        'size_id' => null,
        'color_id' => null
    ];

    public function mount(){
        $this->weights = $this->product->weights;
        $image = Storage::url($this->product->images->first());
        
        if($image == "http://bonanzasonline.com/storage/"){
            $this->options['image'] = asset('images/no_available_image.png');
        }else{
            $this->options['image'] = Storage::url($this->product->images->first()->url);
        }
    }

    public function updatedWeightId($value){
        $weight = $this->product->weights->find($value);
        $this->factor = $weight->factor;
        $this->quantity = qty_available($this->product->id, null, null, $weight->id);

        $this->options['weight'] = $weight->name;
        $this->options['weight_id'] = $weight->id;
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
                    'price' => $this->product->price * $this->factor,
                    'options' => $this->options,
                    ]
                );
        
        $this->quantity = qty_available($this->product->id, null, null, $this->weight_id);
        
        $this->reset([
            'qty'
        ]);
        
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobil', 'render');
    }
    
    public function render()
    {
        return view('livewire.add-cart-item-weight');
    }
}
