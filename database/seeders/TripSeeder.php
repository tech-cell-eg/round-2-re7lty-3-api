<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trips')->insert([
            ['location' => 'القاهرة', 'price' => 2500.00, 'duration_days' => 5, 'image' => 'trips/cairo.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['location' => 'الإسكندرية', 'price' => 1800.00, 'duration_days' => 3, 'image' => 'trips/alex.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
