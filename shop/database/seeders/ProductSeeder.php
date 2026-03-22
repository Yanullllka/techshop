<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'brand_id' => 1,
            'name' => 'iPhone 15',
            'slug' => 'iphone-15',
            'description' => 'Современный смартфон Apple',
            'price' => 120000,
            'old_price' => 130000,
            'stock' => 10,
            'image' => 'iphone.jpg'
        ]);

        Product::create([
            'category_id' => 2,
            'brand_id' => 1,
            'name' => 'MacBook Air M2',
            'slug' => 'macbook-air-m2',
            'description' => 'Лёгкий и мощный ноутбук',
            'price' => 150000,
            'old_price' => null,
            'stock' => 5,
            'image' => 'macbook.jpg'
        ]);

        Product::create([
            'category_id' => 1,
            'brand_id' => 2,
            'name' => 'Samsung Galaxy S24',
            'slug' => 'samsung-galaxy-s24',
            'description' => 'Флагманский смартфон Samsung',
            'price' => 100000,
            'old_price' => 110000,
            'stock' => 8,
            'image' => 'samsung.jpg'
        ]);
    }
}