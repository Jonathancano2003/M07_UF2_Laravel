<?php

namespace Database\Factories;

use App\Models\Actor;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthdate' => $this->faker->date(),
            'country' => $this->faker->country(),
            'img_url' => $this->faker->imageUrl(),
        ];
    }
}
