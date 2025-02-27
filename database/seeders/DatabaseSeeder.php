<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario Roman
        User::factory()->create([
            'name' => 'Roman',
            'email' => 'roman@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $this->call(CategoriesSeeder::class);
        $this->call(ProductsSeeder::class);
    }
}
