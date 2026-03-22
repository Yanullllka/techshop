<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        Wishlist::create([
            'user_id' => 2,
            'product_id' => 1
        ]);

        Wishlist::create([
            'user_id' => 2,
            'product_id' => 3
        ]);
    }
}