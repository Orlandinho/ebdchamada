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
            'name' => $this->faker->name(),
            'slug' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'dob' => $this->faker->dateTimeBetween('-35 years', '-18 years'),
            'active' => true,
            'visitor' => false,
            'avatar' => 'avatars/default'.rand(1,5).'.png'
        ];
    }
}
