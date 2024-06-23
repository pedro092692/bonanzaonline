<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        Storage::deleteDirectory('categories');
        Storage::makeDirectory('categories');

        Storage::deleteDirectory('subcategories');
        Storage::makeDirectory('subcategories');

        $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(SubcategorySeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ColorSeeder::class);
        // $this->call(ColorProductSeeder::class);
        // $this->call(SizeSeeder::class);
        // $this->call(ColorSizeSeeder::class);
        // $this->call(WeightSeeder::class);
        // $this->call(ProductWeightSeeder::class);
        // $this->call(DepartmentSeeder::class);
    }
}
