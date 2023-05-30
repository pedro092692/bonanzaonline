<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            //fruits and vegetables
            [
                'category_id' => 1,
                'name' => 'Frutas',
                'slug' => Str::slug('Frutas'),
                'weight' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Verduras',
                'slug' => Str::slug('verduras'),
            ],
            [
                'category_id' => 1,
                'name' => 'Aliños',
                'slug' => Str::slug('Aliños'),
            ],
             //groceries
             [
                'category_id' => 2,
                'name' => 'Harinas',
                'slug' => Str::slug('harinas'),
            ],
            [
                'category_id' => 2,
                'name' => 'Enlatados',
                'slug' => Str::slug('Enlatados'),
            ],
            [
                'category_id' => 2,
                'name' => 'Cereales',
                'slug' => Str::slug('Cereales'),
                'color' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Pastas',
                'slug' => Str::slug('Pastas'),
            ],
            [
                'category_id' => 2,
                'name' => 'Condimentos',
                'slug' => Str::slug('Condimentos'),
            ],
             //delicatessen
             [
                'category_id' => 3,
                'name' => 'Jamones',
                'slug' => Str::slug('Jamones'),
                'weight' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Quesos',
                'slug' => Str::slug('Quesos'),
            ],
            [
                'category_id' => 3,
                'name' => 'Varios',
                'slug' => Str::slug('Varios'),               
                'color' => true,
                'size' => true
            ],
            //Meats
            [
                'category_id' => 4,
                'name' => 'Res',
                'slug' => Str::slug('Res'),
                'weight' => true
            ],
            [
                'category_id' => 4,
                'name' => 'Pollo',
                'slug' => Str::slug('Pollo'),
            ],
             //Persoanal care
             [
                'category_id' => 5,
                'name' => 'Jabones',
                'slug' => Str::slug('Jabones'),
            ],
            [
                'category_id' => 5,
                'name' => 'Desodorantes',
                'slug' => Str::slug('Desodorantes'),
            ],
            [
                'category_id' => 5,
                'name' => 'Afeitadoras',
                'slug' => Str::slug('Afeitadoras'),
            ],
            [
                'category_id' => 5,
                'name' => 'Shampoo',
                'slug' => Str::slug('Shampoo'),
            ],
            [
                'category_id' => 5,
                'name' => 'Crema Dental',
                'slug' => Str::slug('Crema Dental'),
            ],
            //candies
            [
                'category_id' => 6,
                'name' => 'Caramelos',
                'slug' => Str::slug('Caramelos'),
            ],
            [
                'category_id' => 6,
                'name' => 'Galletas',
                'slug' => Str::slug('Galletas'),
            ],
            [
                'category_id' => 6,
                'name' => 'Chocolates',
                'slug' => Str::slug('Chocolates'),
            ],
            [
                'category_id' => 6,
                'name' => 'Varios',
                'slug' => Str::slug('Varios'),
                'color' => true,
                'size' => true
            ],
        ];

        foreach ($subcategories as $subcategory){
            Subcategory::create($subcategory);
        }
    }
}
