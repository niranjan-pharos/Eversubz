<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobExperience;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $experiences = [
            ['name' => 'Beginner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '1+ year', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '2+ years', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '3+ years', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '4+ years', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '5+ years', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '10+ years', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '15+ years', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($experiences as $experience) {
            JobExperience::firstOrCreate(['name' => $experience['name']], $experience);
        }
    }
}
