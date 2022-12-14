<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            'order_id' => 1,
            'employee_id' => 2,
            'payment'=> 100000,
            'change' => 40000, 
        ];

        Payment::insert($payments);
    }
}