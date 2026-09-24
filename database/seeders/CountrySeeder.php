<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ========================================
        // الخطوة 1: إدخال الدول المهمة (5 دول)
        // ========================================
        $importantCountries = [
            ['name' => 'المملكة العربية السعودية', 'active' => 1],
            ['name' => 'مصر', 'active' => 1],
            ['name' => 'الإمارات العربية المتحدة', 'active' => 1],
            ['name' => 'الكويت', 'active' => 1],
            ['name' => 'قطر', 'active' => 1],
        ];

        foreach ($importantCountries as $country) {
            Country::firstOrCreate(
                ['name' => $country['name']],
                ['active' => $country['active']]
            );
        }  // ✅ قوس الإغلاق الصحيح

        // ========================================
        // الخطوة 2: إنشاء 15 دولة عشوائية (خارج الـ foreach!)
        // ========================================
        Country::factory()
            ->count(15)
            ->active()
            ->create();
    }
}