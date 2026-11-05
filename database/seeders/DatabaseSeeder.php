<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Impor Model
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data Kategori
        $atk = Category::create(['name' => 'ATK']);
        $elk = Category::create(['name' => 'Elektronik']);

        // Data Item / Barang
        $atk->items()->create([
            'name' => 'Kertas A4',
            'stock' => 40,
            'price' => 55000,
        ]);
        $elk->items()->create([
            'name' => 'Mouse USB',
            'stock' => 12,
            'price' => 75000,
        ]);

        User::factory()->create([
            'email' => 'admin@inventaris.test',
        ]);
    }
}
