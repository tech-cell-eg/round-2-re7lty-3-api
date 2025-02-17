<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            ['price' => 5000.00, 'plan_type' => 'economic', 'target_type' => 'individual', 'description' => 'خطة اقتصادية رائعة', 'options' => json_encode(['وجبات مجانية', 'رحلات سياحية']), 'created_at' => now(), 'updated_at' => now()],
            ['price' => 8000.00, 'plan_type' => 'business', 'target_type' => 'group', 'description' => 'خطة أعمال فاخرة', 'options' => json_encode(['VIP Lounge', 'تأمين سفر']), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
