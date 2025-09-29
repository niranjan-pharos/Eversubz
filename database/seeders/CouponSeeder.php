<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'code' => 'EVENT2024',
                'discount' => 10.00, // $10 discount
                'module_name' => 'event',
                'is_valid' => true,
                'expires_at' => Carbon::now()->addDays(10), // Valid for the next 10 days
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'EVENTEXPIRED',
                'discount' => 15.00, // $15 discount
                'module_name' => 'event',
                'is_valid' => true,
                'expires_at' => Carbon::now()->subDays(1), // Already expired
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'EVENT50OFF',
                'discount' => 50.00, // $50 discount
                'module_name' => 'event',
                'is_valid' => true,
                'expires_at' => Carbon::now()->addDays(30), // Valid for the next 30 days
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'EVENTINVALID',
                'discount' => 20.00, // $20 discount
                'module_name' => 'event',
                'is_valid' => false, // Invalid coupon
                'expires_at' => Carbon::now()->addDays(5), // Valid date but marked invalid
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
