<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingRequest;
use App\Models\Country;
use App\Models\Course;
use App\Models\Entrolment;
use App\Models\Student;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $training_data = Training::all();
        if (! empty($training_data)) {
            foreach ($training_data as $info) {
                $info->course_name = Country::where('id', '=', $info->course)->value('name');
            }
        }

        return view('trainings.index', ['training_data' => $training_data]);
    }

    public function create()
    {
        $courses = Course::select('id', 'name')->where('active', 1)->get();

        return view('trainings.create', ['courses' => $courses]);
    }

    public function store(TrainingRequest $request)
    {
        $student = new Training;
        $student->courseID = $request->courseID;
        $student->start_date = $request->start_date;
        $student->end_date = $request->end_date;
        $student->price = $request->price;
        $student->notes = $request->notes;
        $student->save();

        return redirect()->route('trainings.index')->with(['success' => 'تم اضافة البيانات']);
    }

    public function edit(int $id)
    {
        $data = Training::findOrFail($id);
        $courses = Course::select('id', 'name')->where('active', 1)->get();

        return view('trainings.edit', ['data' => $data, 'courses' => $courses]);
    }

    public function update(TrainingRequest $request, int $id)
    {
        $training = Training::findOrFail($id);
        $training->courseID = $request->courseID;
        $training->start_date = $request->start_date;
        $training->end_date = $request->end_date;
        $training->price = $request->price;
        $training->notes = $request->notes;
        $training->save();

        return redirect()->route('trainings.index')->with(['success' => 'تم تحديث بيانات الدورة بنجاح']);
    }

    public function destroy(int $id)
    {
        $training = Training::findOrFail($id);
        $training->delete();

        return redirect()->route('trainings.index')->with(['success' => 'تم حذف بيانات الدورة بنجاح']);
    }

    public function details(int $id)
    {
        $training = Training::findOrFail($id);
        $course = Course::findOrFail($training->courseID);

        $training['course_name'] = Course::where('id', '=', $training->courseID)->value('name');

        $training['studentCounter'] = Entrolment::where('courseID', '=', $training->courseID)->count();

        return view('trainings.details', ['data' => $training, 'course' => $course]);
    }

    public function add_student($id)
    {
        $training = Training::findOrFail($id);
        $course = Course::findOrFail($training->courseID);
        $students = Student::select('id', 'name')->where('active', 1)->get();

        if (empty($training)) {
            return redirect()->route('trainings.index')->with(['error' => 'الدورة غير موجودة']);
        }

        return view('trainings.add_student', ['data' => $training, 'course' => $course, 'students' => $students]);
    }

    public function store_student($id, Request $request)
    {
        $training = Training::findOrFail($id);
        $course = Course::findOrFail($training->courseID);

        if (empty($training)) {
            return redirect()->route('trainings.index')->with(['error' => 'الدورة غير موجودة']);
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'enrolements_date' => 'required|date',
        ]);

        // Check if the student is already enrolled in the course
        $existingEnrollment = Entrolment::where('courseID', $training->courseID)
            ->where('studentID', $validated['student_id'])
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('trainings.details', $id)->with(['error' => 'الطالب مسجل بالفعل في هذه الدورة']);
        }

        // Create a new enrollment
        $enrollment = new Entrolment;
        $enrollment->courseID = $training->courseID;
        $enrollment->studentID = $validated['student_id'];
        $enrollment->enrolements_date = $validated['enrolements_date'];
        $enrollment->save();

        return redirect()->route('trainings.details', $id)->with(['success' => 'تم إضافة الطالب بنجاح']);
    }
}
