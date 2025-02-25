<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        // Productos para categoría con id = 1
        Product::create([
            'name' => 'Croissants xocolata',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants de xocolata petit',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants normal',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants normal petit',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants cereals',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants de mantega',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants de xocolata blanca',
            'quantity' => 0,
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Croissants de xocolata blanca petit',
            'quantity' => 0,
            'category_id' => 1
        ]);



        // Productos para categoría con id = 2
        Product::create([
            'name' => 'Barra de 1/4',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Pa de vidre',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Multicereals',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Espelta Eco',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Llonguet Integral',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Llonguet Avena',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Llonguet Petit',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Llonguet Mitja',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Llonguet Perelada',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Panet Rustic',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Mini Cereals',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Mini Anous',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Charito',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Coca Sucre',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Pizza',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Pistoles',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Panet Gros',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Panet Petit',
            'quantity' => 0,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Panet Mini',
            'quantity' => 0,
            'category_id' => 2
        ]);


         // Productos para categoría con id = 3
        Product::create([
            'name' => 'Donut',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Ensaimades Xoco',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Ensaimades Cabell',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Ensaimades Petits',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Magdalenas Normals',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Magdalenas Integrals',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Xuixo',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Empanada Carn',
            'quantity' => 0,
            'category_id' => 3
        ]);
        Product::create([
            'name' => 'Empanada Atun',
            'quantity' => 0,
            'category_id' => 3
        ]);

        // Productos para categoría con id = 4
        Product::create([
            'name' => 'Canya Cabell',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Canya Choco',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Flauta Choco',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Palmeras',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Brechel',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Triangles',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Poma Grossa',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Poma Mitjana',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Poma Petita',
            'quantity' => 0,
            'category_id' => 4
        ]);
        Product::create([
            'name' => 'Full Mantega',
            'quantity' => 0,
            'category_id' => 4
        ]);


        // Productos para categoría con id = 5
        Product::create([
            'name' => 'Pa de Pessic Gros',
            'quantity' => 0,
            'category_id' => 5
        ]);
        Product::create([
            'name' => 'Pa de Pessic Petit',
            'quantity' => 0,
            'category_id' => 5
        ]);
        Product::create([
            'name' => 'Pa de Pessic Xoco Gros',
            'quantity' => 0,
            'category_id' => 5
        ]);
        Product::create([
            'name' => 'Pa de Pessic Xoco Petit',
            'quantity' => 0,
            'category_id' => 5
        ]);
        Product::create([
            'name' => 'Pa de Pessic de Poma',
            'quantity' => 0,
            'category_id' => 5
        ]);
        Product::create([
            'name' => 'Pa de Pessic Gardella',
            'quantity' => 0,
            'category_id' => 5
        ]);


        // Productos para categoría con id = 6
        Product::create([
            'name' => 'Tortell Gros',
            'quantity' => 0,
            'category_id' => 6
        ]);
        Product::create([
            'name' => 'Tortell Petit',
            'quantity' => 0,
            'category_id' => 6
        ]);
        Product::create([
            'name' => 'Tortell Crema',
            'quantity' => 0,
            'category_id' => 6
        ]);
        Product::create([
            'name' => 'Tortell Nata',
            'quantity' => 0,
            'category_id' => 6
        ]);


        
        // Productos para categoría con id = 7
        Product::create([
            'name' => 'Coca grossa',
            'quantity' => 0,
            'category_id' => 7
        ]);
        Product::create([
            'name' => 'Coca Mitjana',
            'quantity' => 0,
            'category_id' => 7
        ]);
        Product::create([
            'name' => 'Coca Petita',
            'quantity' => 0,
            'category_id' => 7
        ]);
        Product::create([
            'name' => 'Coca Individual',
            'quantity' => 0,
            'category_id' => 7
        ]);
        Product::create([
            'name' => 'Greixons',
            'quantity' => 0,
            'category_id' => 7
        ]);
    }
}
