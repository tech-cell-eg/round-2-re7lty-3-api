<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            ['user_id' => 1, 'name' => 'محمد أحمد', 'content' => 'رحلة رائعة جدًا، أنصح بها!', 'image' => 'reviews/user1.jpg', 'rating' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'name' => 'سارة علي', 'content' => 'الخدمة كانت ممتازة جدًا والموظفين محترفين', 'image' => 'reviews/user2.jpg', 'rating' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
