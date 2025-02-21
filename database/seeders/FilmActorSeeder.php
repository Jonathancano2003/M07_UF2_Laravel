<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    public function run()
    {
        $films = DB::table('films')->pluck('id')->toArray();
        $actors = DB::table('actors')->pluck('id')->toArray();

        foreach ($films as $filmId) {
            $randomActors = array_rand($actors, rand(1, 3));

            foreach ((array) $randomActors as $actorIndex) {
                DB::table('films_actors')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actors[$actorIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
