<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 20;
        $faker = Factory::create();
        $customers = [];

        for ($i = 0; $i < $limit; $i++) {

            $customers[$i] = [
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'phone' =>   '0' . rand(100000000, 999999999),
                'password' => Hash::make('123456'),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ];
        }
        DB::table('users')->insert($customers);
    }
}
