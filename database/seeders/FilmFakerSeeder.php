<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert([
                'name' => $faker->sentence(3),
                'year' => $faker->year(),
                'genre' => $faker->word(),
                'country' => $faker->country(),
                'duration' => $faker->numberBetween(80, 180),
                'img_url' => $faker->imageUrl(200, 300, 'movies'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
