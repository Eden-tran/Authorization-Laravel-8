<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
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
        $flight = [];

        for ($i = 0; $i < $limit; $i++) {

            $flight[$i] = [

                'created_at' => $faker->dateTime(),

                'updated_at' => $faker->dateTime()

            ];
        }
        DB::table('flights')->insert($flight);
    }
}
