<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            ['name' => 'Ahmed', 'email' => 'ahmed@example.com', 'subject' => 'استفسار عن رحلة', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'laila', 'email' => 'laila@example.com', 'subject' => 'طلب عرض سعر', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
