<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            [
            'user_id' => 2,	
            'date_of_birth' => '2001-06-06',
            'address' => 'Jalan Kesumba No 23',
            'phone' => '+62876543219',
            'sex' => 'M',
            ],
            [
            'user_id' => 3,	
            'date_of_birth' => '2002-07-07',
            'address' => 'Jalan Kayu Putih No 33',
            'phone' => '+62879087645',
            'sex' => 'F',
            ],
        ];

        Employee::insert($employees);
    }
}