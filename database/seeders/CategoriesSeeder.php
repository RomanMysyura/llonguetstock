<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Croissants',    'imageurl' => '/img/croissant-svgrepo-com.svg'],
            ['name' => 'Pa',            'imageurl' => '/img/bread-svgrepo-com.svg'],
            ['name' => 'Brioxeria',     'imageurl' => '/img/cookie-line-svgrepo-com.svg'],
            ['name' => 'Pasta Full',    'imageurl' => '/img/bretzel-svgrepo-com.svg'],
            ['name' => 'Pa de pessic',  'imageurl' => '/img/cake-duotone-svgrepo-com.svg'],
            ['name' => 'Tortells',       'imageurl' => '/img/cake-piece-of-cake-svgrepo-com.svg'],
            ['name' => 'Coques',        'imageurl' => '/img/coke-svgrepo-com.svg'],
            ['name' => 'Altres',      'imageurl' => '/img/more-svgrepo-com.svg'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}