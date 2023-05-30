<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(2);
        $subcategory = Subcategory::all()->random();

        $category = $subcategory->category;
        $brands = $category->brands->random();
        
        if ($subcategory->color){
            $quantity = null;
        }else{
            $quantity = 4;
        }

        return [
            'name' => $name, 
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([1.99, 3.99, 4.99]),
            'subcategory_id' => $subcategory->id,
            'brand_id' => $brands->id,
            'quantity' => $quantity,
            'status' => 1
        ];
    }
}
