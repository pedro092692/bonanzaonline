<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('color', true)
                  ->where('size', true);
        })->get(); 

        $sizes = ['S', 'M', 'L', 'XL'];

        foreach($products as $product){
            foreach($sizes as $size){
                $product->sizes()->create([
                    'name' => $size
                ]);
            }   
        }
    }
}
