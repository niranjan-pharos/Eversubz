<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobTag;

class JobTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined tags
        $tags = [
            ['tag_name' => 'Remote', 'created_at' => now(), 'updated_at' => now()],
            ['tag_name' => 'Full-Time', 'created_at' => now(), 'updated_at' => now()],
            ['tag_name' => 'Part-Time', 'created_at' => now(), 'updated_at' => now()],
            ['tag_name' => 'Internship', 'created_at' => now(), 'updated_at' => now()],
            ['tag_name' => 'Freelance', 'created_at' => now(), 'updated_at' => now()],
            ['tag_name' => 'Urgent', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert predefined tags if they don't exist
        foreach ($tags as $tag) {
            JobTag::firstOrCreate(['tag_name' => $tag['tag_name']], $tag);
        }

        // Generate random tags using the factory
        JobTag::factory()->count(20)->create();
    }
}
