<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->name(),
            'profile_image' => $this->faker->imageUrl(640, 480, 'people'),
            'bio' => $this->faker->paragraph(),
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'location_name' => $this->faker->city() . ', ' . $this->faker->country(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'looking_for_type' => $this->faker->randomElements(['romantic', 'friends'], 2),
            'looking_for_gender' => $this->faker->randomElements(['male', 'female'], 2),
        ];
    }
}
