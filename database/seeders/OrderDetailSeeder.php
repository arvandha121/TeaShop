<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_details = [
            [
                'menu_id' => 1,
                'order_id' => 1,
                'qty' =>2,
            ],
            [
                'menu_id' => 2,
                'order_id' => 1,
                'qty' =>2,
            ],
        ];

        OrderDetail::insert($order_details);
    }
}