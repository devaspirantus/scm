<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Student;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ajax_search_returns_students_matching_the_name(): void
    {
        $country = Country::create(['name' => 'Country', 'active' => 1]);
        Student::create([
            'name' => 'Matching Student',
            'phone' => '123456789',
            'address' => 'Address',
            'image' => 'student.jpg',
            'nationalID' => '1234567890',
            'notes' => '',
            'active' => 1,
            'country_id' => $country->id,
        ]);
        Student::create([
            'name' => 'Different Student',
            'phone' => '987654321',
            'address' => 'Address',
            'image' => 'student-2.jpg',
            'nationalID' => '0987654321',
            'notes' => '',
            'active' => 1,
            'country_id' => $country->id,
        ]);

        $response = $this->withoutMiddleware(PreventRequestForgery::class)
            ->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->post(route('students.ajax_search_student'), ['name' => 'Matching']);

        $response->assertOk()
            ->assertSee('Matching Student')
            ->assertDontSee('Different Student')
            ->assertSee('Country');
    }
}
