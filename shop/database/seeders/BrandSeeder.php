<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::create([
            'name' => 'Apple',
            'slug' => 'apple'
        ]);

        Brand::create([
            'name' => 'Samsung',
            'slug' => 'samsung'
        ]);

        Brand::create([
            'name' => 'Lenovo',
            'slug' => 'lenovo'
        ]);

        Brand::create([
            'name' => 'Xiaomi',
            'slug' => 'xiaomi'
        ]);

        Brand::create([
            'name' => 'LG',
            'slug' => 'lg'
        ]);

        Brand::create([
            'name' => 'Logitech',
            'slug' => 'logitech'
        ]);

        Brand::create([
            'name' => 'Bosch',
            'slug' => 'bosch'
        ]);
    }
}