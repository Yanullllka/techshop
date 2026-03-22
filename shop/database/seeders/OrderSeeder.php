<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_id' => 2,
            'total_price' => 120000,
            'status' => 'new',
            'address' => 'Москва, ул. Ленина 10',
            'payment_method' => 'card'
        ]);
    }
}