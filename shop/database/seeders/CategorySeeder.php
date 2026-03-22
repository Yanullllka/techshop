<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Смартфоны',
            'slug' => 'smartphones'
        ]);

        Category::create([
            'name' => 'Ноутбуки',
            'slug' => 'laptops'
        ]);

        Category::create([
            'name' => 'Телевизоры',
            'slug' => 'tv'
        ]);
    }
}