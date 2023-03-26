<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
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
        $posts = [];

        for ($i = 0; $i < $limit; $i++) {

            $posts[$i] = [
                'title' => $faker->realText(50),
                'content' => $faker->randomHtml(2, 3),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
