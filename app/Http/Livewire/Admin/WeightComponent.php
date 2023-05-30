<?php

namespace App\Http\Livewire\Admin;

use App\Models\Weight;
use Livewire\Component;

class WeightComponent extends Component
{
    protected $listeners = ['delete'];

    public $weights, $weight;

    public $createForm=[
        'name' => null,
        'factor' => null,
    ];

    public $editForm=[
        'open' => false,
        'name' => null,
        'factor' => null
    ];

    public $rules = [
        'createForm.name' => 'required',
        'createForm.factor' => 'required|numeric',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.factor' => 'factor de multiplicacion',
    ];

    public function mount(){
        $this->getWeights();
    }

    public function getWeights(){
        $this->weights = Weight::all();
    }

    public function save(){
        $this->validate();

        Weight::create($this->createForm);

        $this->reset('createForm');

        $this->getWeights();

    }

    public function edit(Weight $weight){
        $this->weight = $weight;
        $this->editForm['open'] = true; 
        $this->editForm['name'] = $weight->name; 
        $this->editForm['factor'] = $weight->factor; 
    }

    public function update(){
        $this->validate([
            'editForm.name' => 'required',
            'editForm.factor' => 'required|numeric',
        ]);

        $this->weight->update($this->editForm);
        $this->reset('editForm');

        $this->getWeights();
    }

    public function delete(Weight $weight){
        dd($weight);
        $weight->delete();
        $this->getWeights();
    }

    public function render()
    {
        return view('livewire.admin.weight-component')->layout('layouts.admin');
    }
}
