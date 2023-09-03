<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{
    public $product, $sizes, $size_id = '', $colors = [], $qty = 1, $quantity = 0, $color_id = "";
    public $options = [];

    public function mount(){
        $this->sizes = $this->product->sizes;
        $image = Storage::url($this->product->images->first());
        
        if($image == "http://bonanzasonline.com/storage/"){
            $this->options['image'] = asset('images/no_available_image.png');
        }else{
            $this->options['image'] = Storage::url($this->product->images->first()->url);
        }
    }

    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

    public function updatedColorId($value){
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
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
        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);
        $this->reset([
            'qty'
        ]);
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobil', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
