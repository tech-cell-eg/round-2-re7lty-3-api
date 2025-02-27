<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([

            ['key' => 'site_name', 'value' => 're7lty'],
            ['key' => 'site_logo', 'value' => 'logo.png'],
            ['key' => 'site_favicon', 'value' => 'favicon.ico'],
            ['key' => 'site_description', 'value' => 'This is a sample website description.'],
            ['key' => 'admin_email', 'value' => 'admin@example.com'],
            ['key' => 'contact_phone', 'value' => '+201234567890'],
            ['key' => 'contact_address', 'value' => '123 Street, City, Country'],


            ['key' => 'facebook_link', 'value' => 'https://facebook.com/re7lty'],
            ['key' => 'twitter_link', 'value' => 'https://twitter.com/re7lty'],
            ['key' => 'instagram_link', 'value' => 'https://instagram.com/re7lty'],
        ]);
    }
}
