<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\JobSkill;

class JobSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Predefined skills
        $skills = [
            ['skill_name' => 'PHP', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'JavaScript', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'Python', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'Java', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'SQL', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'AWS', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'React', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'Node.js', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'Docker', 'created_at' => now(), 'updated_at' => now()],
            ['skill_name' => 'Git', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Option 1: Insert predefined skills
        foreach ($skills as $skill) {
            JobSkill::firstOrCreate(['skill_name' => $skill['skill_name']], $skill);
        }

        // Option 2: Add random skills using the factory
        JobSkill::factory()->count(10)->create();
    }
}
