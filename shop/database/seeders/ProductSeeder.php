<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'iPhone 15',
            'slug' => Str::slug('iPhone 15'),
            'description' => 'Смартфон Apple',
            'price' => 90000,
            'stock' => 15,
            'brand_id' => 1,
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S23',
            'slug' => Str::slug('Samsung Galaxy S23'),
            'description' => 'Смартфон Samsung',
            'price' => 80000,
            'stock' => 10,
            'brand_id' => 2,
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Ноутбук Lenovo',
            'slug' => Str::slug('Ноутбук Lenovo'),
            'description' => 'Мощный ноутбук',
            'price' => 70000,
            'stock' => 15,
            'brand_id' => 3,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'MacBook Air',
            'slug' => Str::slug('MacBook Air'),
            'description' => 'Ноутбук Apple',
            'price' => 120000,
            'stock' => 12,
            'brand_id' => 1,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Пылесос Xiaomi',
            'slug' => Str::slug('Пылесос Xiaomi'),
            'description' => 'Для дома',
            'price' => 15000,
            'stock' => 15,
            'brand_id' => 4,
            'category_id' => 3,
        ]);

        Product::create([
            'name' => 'Телевизор LG',
            'slug' => Str::slug('Телевизор LG'),
            'description' => 'Smart TV',
            'price' => 50000,
            'stock' => 15,
            'brand_id' => 5,
            'category_id' => 3,
        ]);

        Product::create([
            'name' => 'Монитор Samsung',
            'slug' => Str::slug('Монитор Samsung'),
            'description' => '27 дюймов',
            'price' => 20000,
            'stock' => 15,
            'brand_id' => 2,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Клавиатура Logitech',
            'slug' => Str::slug('Клавиатура Logitech'),
            'description' => 'Механическая',
            'price' => 5000,
            'stock' => 15,
            'brand_id' => 6,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Мышь Logitech',
            'slug' => Str::slug('Мышь Logitech'),
            'description' => 'Беспроводная',
            'price' => 3000,
            'stock' => 15,
            'brand_id' => 6,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Холодильник Bosch',
            'slug' => Str::slug('Холодильник Bosch'),
            'description' => 'Большой холодильник',
            'price' => 60000,
            'stock' => 15,
            'brand_id' => 7,
            'category_id' => 3,
        ]);
    }
}