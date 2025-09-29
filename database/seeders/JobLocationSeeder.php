<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\JobLocation;

class JobLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Predefined locations
        $locations = [
            ['location_name' => 'New York', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'San Francisco', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Los Angeles', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Chicago', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Houston', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Miami', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Boston', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Seattle', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Austin', 'created_at' => now(), 'updated_at' => now()],
            ['location_name' => 'Denver', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Option 1: Insert predefined locations
        foreach ($locations as $location) {
            JobLocation::firstOrCreate(['location_name' => $location['location_name']], $location);
        }

        // Option 2: Add random locations using the factory
        JobLocation::factory()->count(10)->create();
    }
}
