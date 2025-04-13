<?php

namespace Database\Factories;

use App\Models\Film;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    protected $model = Film::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'year' => $this->faker->year(),
            'genre' => $this->faker->word(),
            'country' => $this->faker->country(),
            'duration' => $this->faker->numberBetween(80, 180),
            'img_url' => $this->faker->imageUrl(),
        ];
    }
}
