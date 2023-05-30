<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Weight;
use App\Models\ProductWeight as Pivot;

class WeightProduct extends Component
{
    public $product, $weights, $weight_id, $quantity, $open = false;

    public $pivot, $pivot_weight_id, $pivot_quantity; 

    protected $listeners = ['delete'];

    protected $rules = [
        'weight_id' => 'required',
        'quantity' => 'required|numeric|min:1'
    ];

    protected $validationAttributes = [
        'quantity' => 'canditdad',
        'weight_id' => 'peso',
        'pivot_quantity' => 'cantidad'
    ];

    public function mount(){
        $this->weights = Weight::all();
    }

    public function save(){
        $this->validate();

        $pivot = Pivot::where('weight_id', $this->weight_id)
        ->where('product_id', $this->product->id)
        ->first();

        if($pivot){
            $pivot->quantity += $this->quantity;
            $pivot->save();
        }else{
            $this->product->weights()->attach([
                $this->weight_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }

       
        $this->reset(['weight_id', 'quantity']);

        $this->emit('saved');

        $this->product = $this->product->fresh();
    }

    public function edit(Pivot $pivot){
        $this->open = true; 
        $this->pivot = $pivot;
        $this->pivot_weight_id = $pivot->weight_id;
        $this->pivot_quantity = $pivot->quantity;

    }

    public function update(){
        // $this->validate([
        //     'pivot_quantity' => 'required|numeric|min:1'
        // ]);

        $this->pivot->weight_id = $this->pivot_weight_id;
        $this->pivot->quantity = $this->pivot_quantity;
        $this->pivot->save();
        $this->product = $this->product->fresh();
        $this->open = false;
    }

    public function delete(Pivot $pivot){
        $pivot->delete();
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        $product_weights = $this->product->weights;
        return view('livewire.admin.weight-product', compact('product_weights'));
    }
}
