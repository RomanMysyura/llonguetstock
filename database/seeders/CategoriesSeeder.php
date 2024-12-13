<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Category::create([
            'name' => 'Croissants',
            'imageurl' => '/img/croissant-svgrepo-com.svg'
        ]);

        Category::create([
            'name' => 'Pa de pessic',
            'imageurl' => '/img/cake-duotone-svgrepo-com.svg'
        ]);
        // Añade más datos si lo deseas
    }
}
