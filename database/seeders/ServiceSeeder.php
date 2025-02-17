<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['name' => 'حجز فندق', 'description' => 'خدمة حجز فندق فخم بأفضل الأسعار', 'image' => 'services/hotel.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تأجير سيارة', 'description' => 'استأجر سيارة بأفضل العروض', 'image' => 'services/car.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
