<?php

namespace Database\Seeders;

use App\Models\Weight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Weightl;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weights = ['10gr', '20gr', '50gr', '100gr', '200gr'];

        foreach($weights as $weight){
            Weight::create([
                'name' => $weight,
                'factor' => preg_replace('/[^0-9]/', '', $weight)/1000
            ]);
        }
    }
}
