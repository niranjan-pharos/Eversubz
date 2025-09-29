<?php

namespace Database\Factories;

use App\Models\JobSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobSkill>
 */
class JobSkillFactory extends Factory
{
    protected $model = JobSkill::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'skill_name' => $this->faker->word, // Generate a random skill name
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
