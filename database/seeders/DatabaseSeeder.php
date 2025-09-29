<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdPost;
use Database\Factories\AdPostFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JobCategorySeeder::class,
            JobLocationSeeder::class,
            JobSkillSeeder::class,
            JobTagSeeder::class,
            JobExperienceSeeder::class,
            JobSeeder::class,
        ]);
    }
}
