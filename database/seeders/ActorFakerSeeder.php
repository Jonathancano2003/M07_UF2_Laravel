<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActorFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'birthdate' => $faker->date(),
                'country' => $faker->country(),
                'img_url' => $faker->imageUrl(200, 300, 'people'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
