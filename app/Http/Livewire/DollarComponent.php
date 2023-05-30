<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Currency;

class DollarComponent extends Component
{

    public $dollar;

    public $createForm = [
        'price' => null
    ];

    protected $rules = [
        'createForm.price' => 'required|numeric|gt:0'
    ];

    protected $validationAttributes = [
        'createForm.price' => 'Precio'
    ];

    public function mount(){
        $this->dollar = Currency::where('name', 'dollar')->first();

    }


    public function save(){
        
        $this->validate();
        
        if(!$this->dollar){
            $this->dollar = Currency::create([
                'name' => 'dollar',
                'value' => $this->createForm['price']
            ]);
            
            $this->reset('createForm');

            $this->dollar = $this->dollar->fresh();

        }else{
            $this->dollar = Currency::where('name', 'dollar')->update([
                'value' => $this->createForm['price']
            ]);

            $this->reset('createForm');

            $this->mount();
        }
    }


    public function render()
    {
        return view('livewire.dollar-component')->layout('layouts.admin');
    }
}
