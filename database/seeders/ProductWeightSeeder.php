<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ProductWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('weight', true)
                  ->where('size', false)
                  ->where('color', false);
        })->get();   

        foreach($products as $product){
            $product->weights()->attach([
                1 => [
                    'quantity' => 4
                ], 
                2 => [
                    'quantity' => 4
                ], 
                3 => [
                    'quantity' => 4
                ], 
                4 => [
                    'quantity' => 4
                ], 
                5 => [
                    'quantity' => 4
                ]
            ]);
        }
    }
}
