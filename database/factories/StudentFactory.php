<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'classroom_id' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->firstName(),
            'slug' => $this->faker->slug(),
            'dob' => $this->faker->dateTimeBetween('-50 years', '-5 years'),
            'active' => true,
            'visitor' => false,
            'avatar' => '/avatars/default.png'
        ];
    }
}
