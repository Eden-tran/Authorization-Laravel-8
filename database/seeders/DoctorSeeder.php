<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert(
            [
                'name' => 'quangtran',
                'email' => 'bin13199@gmail.com',
                'password' => Hash::make('123456'),
                'is_active' => 1
            ]

        );
    }
}
