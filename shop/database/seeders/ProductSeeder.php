<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        Product::create([
            'name' => 'iPhone 15',
            'slug' => Str::slug('iPhone 15'),
            'description' => 'Смартфон Apple',
            'price' => 999,
            'image' => 'https://i.postimg.cc/26BvyKNK/iphone15.png',
            'brand_id' => 1,
            'category_id' => 1,
            'stock' => 15,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S24',
            'slug' => Str::slug('Samsung Galaxy S24'),
            'description' => 'Смартфон Samsung',
            'price' => 899,
            'image' => 'https://i.postimg.cc/kMpZkVTr/samsung24.png',
            'brand_id' => 2,
            'category_id' => 1,
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'MacBook Air M2',
            'slug' => Str::slug('MacBook Air M2'),
            'description' => 'Ноутбук Apple',
            'price' => 1299,
            'image' => 'https://i.postimg.cc/X7FbLcn7/mac.jpg',
            'brand_id' => 1,
            'category_id' => 2,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Xiaomi 14 Ultra',
            'slug' => Str::slug('Xiaomi 14 Ultra'),
            'description' => 'Смартфон Xiaomi',
            'price' => 799,
            'image' => 'https://mobilguru.by/image/cache/catalog/1Xiaomi/222/Xiaomi%2014%20Ultra/xiaomi-14-ultra-1-500x400.jpg',
            'brand_id' => 3,
            'category_id' => 1,
            'stock' => 12,
        ]);

        Product::create([
            'name' => 'iPad Pro',
            'slug' => Str::slug('iPad Pro'),
            'description' => 'Планшет Apple',
            'price' => 1099,
            'image' => 'https://mobilworld.by/upload/iblock/652/652891a4f45d707742e831a006538b7c.jpg',
            'brand_id' => 1,
            'category_id' => 3,
            'stock' => 8,
        ]);

        Product::create([
            'name' => 'Sony WH-1000XM5',
            'slug' => Str::slug('Sony WH-1000XM5'),
            'description' => 'Наушники Sony',
            'price' => 349,
            'image' => 'https://static.1k.by/images/products/ip/big/pp7/2/4973973/i6d077219f.jpg',
            'brand_id' => 4,
            'category_id' => 4,
            'stock' => 25,
        ]);
    }
}