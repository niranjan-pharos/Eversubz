<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobExperience;
use App\Models\JobSkill;
use App\Models\JobTag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        // Ensure there are records in related tables
        $category = JobCategory::inRandomOrder()->first();
        $location = JobLocation::inRandomOrder()->first();
        $experience = JobExperience::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        if (!$category || !$location || !$experience || !$user) {
            throw new \Exception('Ensure JobCategory, JobLocation, JobExperience, and User tables have records.');
        }

        return [
            'title' => $this->faker->jobTitle,
            'slug' => $this->faker->unique()->slug, // Ensure unique slugs
            'category_id' => $category->id,
            'location_id' => $location->id,
            'description' => $this->faker->paragraphs(3, true),
            'requirements' => $this->faker->paragraphs(2, true),
            'posted_by' => $user->id,
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'is_urgent' => $this->faker->boolean(10),  // 10% chance of being urgent
            'experience_id' => $experience->id,
            'job_mode' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'WFH', 'Internship', 'Contract Base']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'expires_at' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
        ];
    }

    /**
     * Additional configuration after creating a Job.
     */
    public function configure()
    {
        return $this->afterCreating(function (Job $job) {
            // Attach random skills and tags
            $skills = JobSkill::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $tags = JobTag::inRandomOrder()->take(rand(1, 3))->pluck('id');

            if ($skills->isEmpty() || $tags->isEmpty()) {
                throw new \Exception('Ensure JobSkill and JobTag tables have records.');
            }

            $job->skills()->attach($skills); // Populate job_job_skill
            $job->tags()->attach($tags);    // Populate job_job_tag
        });
    }
}
