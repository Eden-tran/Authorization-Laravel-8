<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FlightSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\PostSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(FlightSeeder::class);
        // $this->call(DoctorSeeder::class);
        $this->call(PostSeeder::class);
    }
}
