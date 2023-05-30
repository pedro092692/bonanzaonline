<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'white', 'blue', 'green', 'red', 'yellow'
        ];

        foreach ($colors as $color){
            Color::create([
                'name' => $color
            ]);
        }

    }
}
