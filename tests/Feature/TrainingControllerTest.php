<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrainingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_form_keeps_the_selected_course_and_links_back_to_trainings(): void
    {
        $course = Course::create(['name' => 'Current course', 'active' => 1]);
        $selectedCourse = Course::create(['name' => 'New course', 'active' => 1]);
        $training = Training::create([
            'courseID' => $course->id,
            'start_date' => '2026-10-01',
            'end_date' => '2026-10-10',
            'price' => 100,
        ]);

        $response = $this->withSession([
            '_old_input' => ['courseID' => $selectedCourse->id],
        ])->get(route('trainings.edit', $training));

        $response->assertOk()
            ->assertSeeInOrder([
                'value="'.$selectedCourse->id.'"',
                'selected',
                'New course</option>',
            ], false)
            ->assertSee('href="'.route('trainings.index').'"', false);
    }

    public function test_update_persists_training_changes_and_redirects_to_the_index(): void
    {
        $course = Course::create(['name' => 'Course', 'active' => 1]);
        $training = Training::create([
            'courseID' => $course->id,
            'start_date' => '2026-10-01',
            'end_date' => '2026-10-10',
            'price' => 100,
            'notes' => 'Old notes',
        ]);

        $response = $this->put(route('trainings.update', $training), [
            'courseID' => $course->id,
            'start_date' => '2026-11-01',
            'end_date' => '2026-11-10',
            'price' => 250,
            'notes' => 'Updated notes',
        ]);

        $response->assertRedirect(route('trainings.index'))
            ->assertSessionHas('success', 'تم تحديث بيانات الدورة بنجاح');
        $this->assertDatabaseHas('trainings', [
            'id' => $training->id,
            'courseID' => $course->id,
            'start_date' => '2026-11-01',
            'end_date' => '2026-11-10',
            'price' => '250.00',
            'notes' => 'Updated notes',
        ]);
    }

    public function test_destroy_deletes_training_and_redirects_to_the_index(): void
    {
        $course = Course::create(['name' => 'Course', 'active' => 1]);
        $training = Training::create([
            'courseID' => $course->id,
            'start_date' => '2026-10-01',
            'end_date' => '2026-10-10',
            'price' => 100,
        ]);

        $response = $this->delete(route('trainings.destroy', $training));

        $response->assertRedirect(route('trainings.index'))
            ->assertSessionHas('success', 'تم حذف بيانات الدورة بنجاح');
        $this->assertDatabaseMissing('trainings', ['id' => $training->id]);
    }

    public function test_edit_update_and_destroy_return_not_found_for_a_missing_training(): void
    {
        $missingId = 999999;
        $validInput = [
            'courseID' => 1,
            'start_date' => '2026-11-01',
            'end_date' => '2026-11-10',
            'price' => 250,
        ];

        $this->get(route('trainings.edit', $missingId))->assertNotFound();
        $this->put(route('trainings.update', $missingId), $validInput)->assertNotFound();
        $this->delete(route('trainings.destroy', $missingId))->assertNotFound();
    }
}
