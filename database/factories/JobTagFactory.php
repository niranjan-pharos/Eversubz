<?php

namespace Database\Factories;

use App\Models\JobTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobTag>
 */
class JobTagFactory extends Factory
{
    protected $model = JobTag::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'tag_name' => $this->faker->unique()->word, // Ensure unique tag names
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
