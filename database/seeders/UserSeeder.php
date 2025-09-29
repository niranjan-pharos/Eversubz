<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'phone' => '9999999999',
                'status' => 'active',
                'password' => bcrypt('user@123456'),
                'address' => 'The Mall, Paris',
            ],
        ]);
    }
}
