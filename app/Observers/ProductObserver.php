<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{
    public function updated(Product $product){
        
        $subcategory_id = $product->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);

        if ($subcategory->size) {

            if ($product->colors->count()) {
                $product->colors()->detach();
            }
            
        }
        elseif ($subcategory->color) {
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }elseif($subcategory->weight){
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
            if ($product->colors->count()) {
                $product->colors()->detach();
            }
        }
        else{
            if ($product->colors->count()) {
                $product->colors()->detach();
            }

            if ($product->weights->count()) {
                $product->weights()->detach();
            }

            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }
    }
}
