<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'role_name' => 'admin'
            ],
            [
                'id' => 2,
                'role_name' => 'kasir'
            ],
            [
                'id' => 3,
                'role_name' => 'staff-dapur'
            ],
            [
                'id' => 4,
                'role_name' => 'buyer'
            ],
        ];
        
        DB::table('roles')->insert($data);
    }
}