<?php

namespace Database\Factories;

use App\Models\JobLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobLocation>
 */
class JobLocationFactory extends Factory
{
    protected $model = JobLocation::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'location_name' => $this->faker->city, // Generate a random city name
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
