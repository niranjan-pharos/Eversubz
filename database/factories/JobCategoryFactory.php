<?php

namespace Database\Factories;
use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobCategory>
 */
class JobCategoryFactory extends Factory
{
    protected $model = JobCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Generate random category name
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
