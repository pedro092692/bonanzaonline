<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Frutas y Verduras',
                'slug' => Str::slug('Frutas y Verduras'),
                'icon' => '<i class="fa-solid fa-carrot"></i>'
            ],
            [
                'name' => 'Viveres',
                'slug' => Str::slug('Viveres'),
                'icon' => '<i class="fa-solid fa-jar"></i>'

            ],
            [
                'name' => 'Charcutería',
                'slug' => Str::slug('Charcuteria'),
                'icon' => '<i class="fa-solid fa-cheese"></i>'
            ],
            [
                'name' => 'Carnes',
                'slug' => Str::slug('Carnes'),
                'icon' => '<i class="fa-solid fa-drumstick-bite"></i>'
            ],
            [
                'name' => 'Cuidado Personal',
                'slug' => Str::slug('Cuidado Persoanl'),
                'icon' => '<i class="fa-solid fa-pump-soap"></i>'
            ],
            [
                'name' => 'Chucherias',
                'slug' => Str::slug('Chucherias'),
                'icon' => '<i class="fa-solid fa-candy-cane"></i>'
            ]
        ];

        foreach ($categories as $category){
            $category = Category::factory(1)->create($category)->first();
            $brands = Brand::factory(4)->create();

            foreach($brands as $brand){
                $brand->categories()->attach($category->id);
            }
        }
    }
}
