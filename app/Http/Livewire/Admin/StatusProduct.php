<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusProduct extends Component
{

    public $product, $status; 

    public function mount(){
        $this->status = $this->product->status;
    } 
    
    public function save(){

        if($this->status == 1 && !$this->product->images->first()){
            $this->emit('errorSize', 'Para publicar el producto tiene que tener al menos una imagen');
        }else{
            $this->product->status = $this->status;
            $this->product->save();
            $this->emit('saved');
        }
        
    }

    public function render()
    {
        return view('livewire.admin.status-product');
    }
}
