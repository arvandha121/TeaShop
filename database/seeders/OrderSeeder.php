<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            'user_id' => 4,
            'token' => Str::random(10),
            'total' => 60000,
            'order_date' => '2022-06-15 11:16:26',
            'status' => 0,
        ];

        Order::insert($orders);
    }
}