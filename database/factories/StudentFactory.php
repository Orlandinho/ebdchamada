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
            'classroom_id' => null,
            'name' => $this->faker->name(),
            'slug' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'dob' => $this->faker->dateTimeBetween('-60 years', '-5 years'),
            'active' => true,
            'visitor' => false,
            'avatar' => 'avatars/default'.rand(1,5).'.png'
        ];
    }
}
