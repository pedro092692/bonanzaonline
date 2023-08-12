<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Currency;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $subcategory_select, $brand_select, $dollar_value;

    public $view = "grid";

    protected $queryString = ['subcategory_select', 'brand_select'];

    public function clean(){
        $this->reset([
            'subcategory_select',
            'brand_select',
            'page'
        ]);
        $this->resetPage();
    }

    public function clean_brand(){
        $this->reset(['brand_select']);
    }
   
    public function clean_subcategory(){
        $this->reset(['subcategory_select']);
    }

    public function updatedSubcategorySelect(){
        $this->resetPage();
    }

    public function updatedBrandSelect(){
        $this->resetPage();
    }

    public function render()
    {
        // $products = $this->category->products()
        //                            ->where('status', 2)
        //                            ->paginate(20);

        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            $query->where('id', $this->category->id)
                  ->where('status', 1);
        });

        if($this->subcategory_select){
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('slug', $this->subcategory_select);
            });
        }

        if($this->brand_select){
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                $query->where('name', $this->brand_select);
            });
        }

        $products = $productsQuery->paginate(20);

        $dollar_value = Currency::where('name', 'dollar')->latest()->first();
        
        $this->dollar_value = $dollar_value;

        return view('livewire.category-filter', compact('products','dollar_value'));
    }
}
