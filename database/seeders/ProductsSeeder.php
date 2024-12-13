<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 10 productos para la categoría con id = 1
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Producto Croissant ' . $i,
                'quantity' => rand(10, 100),
                'category_id' => 1
            ]);
        }

        // 10 productos para la categoría con id = 2
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Producto Pa de pessic ' . $i,
                'quantity' => rand(10, 100),
                'category_id' => 2
            ]);
        }
    }
}
