<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        $arabicCountries = [
            'المملكة العربية السعودية',
            'مصر',
            'الإمارات العربية المتحدة',
            'الكويت',
            'قطر',
            'البحرين',
            'عمان',
            'الأردن',
            'لبنان',
            'سوريا',
            'العراق',
            'اليمن',
            'ليبيا',
            'تونس',
            'الجزائر',
            'المغرب',
            'موريتانيا',
            'السودان',
            'الصومال',
            'جزر القمر',
            'جيبوتي',
            'فلسطين',
        ];

        return [
            'name'   => fake()->randomElement($arabicCountries),
            'active' => fake()->boolean(80),
        ];
    }

    public function active(): static
    {
        return $this->state(fn(array $attributes) => [
            'active' => 1,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'active' => 0,
        ]);
    }
}