<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::create([
            'user_id' => 2,
            'product_id' => 1,
            'rating' => 5,
            'comment' => 'Отличный телефон!'
        ]);

        Review::create([
            'user_id' => 2,
            'product_id' => 3,
            'rating' => 4,
            'comment' => 'Очень хороший смартфон.'
        ]);
    }
}