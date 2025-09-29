<?php

namespace Database\Factories;

use App\Models\JobExperience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobExperience>
 */
class JobExperienceFactory extends Factory
{
    protected $model = JobExperience::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, // Random word for experience level
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
