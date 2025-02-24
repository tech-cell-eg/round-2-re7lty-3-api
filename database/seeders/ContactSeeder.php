<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'phone' => '01012345678',
                'address' => 'شارع التحرير، القاهرة',
                'subject' => 'استفسار عن الخدمة',
                'message' => 'أرغب في معرفة المزيد عن خدماتكم.',
                'admin_reply' => null,
                'is_replied' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'منى علي',
                'email' => 'mona@example.com',
                'phone' => '01098765432',
                'address' => 'مدينة نصر، القاهرة',
                'subject' => 'طلب دعم فني',
                'message' => 'لدي مشكلة تقنية وأحتاج إلى مساعدة.',
                'admin_reply' => 'سنقوم بالتواصل معك قريبًا.',
                'is_replied' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
