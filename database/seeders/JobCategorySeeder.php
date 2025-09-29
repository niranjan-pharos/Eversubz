<?php

namespace Database\Seeders;
use App\Models\JobCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Use delete instead of truncate to avoid foreign key constraint issues
        DB::table('job_categories')->delete();

        // Predefined categories
        $categories = [
            ['name' => 'Software Development', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Healthcare', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Education', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Construction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Logistics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Customer Service', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sales', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert predefined categories
        DB::table('job_categories')->insert($categories);

        // Insert additional random categories using the factory
        JobCategory::factory()->count(10)->create();
    }
}
