<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobExperience;
use App\Models\User;
use App\Models\JobSkill;
use App\Models\JobTag;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure related tables have records
        if (
            JobCategory::count() === 0 ||
            JobLocation::count() === 0 ||
            JobExperience::count() === 0 ||
            User::count() === 0 ||
            JobSkill::count() === 0 ||
            JobTag::count() === 0
        ) {
            throw new \Exception('Ensure JobCategory, JobLocation, JobExperience, User, JobSkill, and JobTag tables have records before running JobSeeder.');
        }

        // Create 30 jobs
        Job::factory()->count(20)->create();
    }
}
