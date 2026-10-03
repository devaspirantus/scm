<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingRequest;
use App\Models\Country; // (يمكنك حذفه إذا لم يعد مستخدماً)
use App\Models\Course;
use App\Models\Entrolment;
use App\Models\Student;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        // ✅ التحسين: جلب اسم الدورة بدلاً من الدولة، وبطريقة أكثر كفاءة
        $training_data = Training::with('course')->get(); 
        
        return view('trainings.index', ['training_data' => $training_data]);
    }

    public function create()
    {
        $courses = Course::select('id', 'name')->where('active', 1)->get();
        return view('trainings.create', ['courses' => $courses]);
    }

    public function store(TrainingRequest $request)
    {
        $training = new Training; // تم تصحيح اسم المتغير من $student إلى $training
        $training->courseID = $request->courseID;
        $training->start_date = $request->start_date;
        $training->end_date = $request->end_date;
        $training->price = $request->price;
        $training->notes = $request->notes;
        $training->save();

        return redirect()->route('trainings.index')->with('success', 'تم اضافة البيانات بنجاح');
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

        return redirect()->route('trainings.index')->with('success', 'تم تحديث بيانات الدورة بنجاح');
    }

    public function destroy(int $id)
    {
        $training = Training::findOrFail($id);
        $training->delete();

        return redirect()->route('trainings.index')->with('success', 'تم حذف بيانات الدورة بنجاح');
    }

    // ✅✅✅ الدالة المحسّنة والمصححة (الأهم) ✅✅✅
    public function details(int $id)
    {
        $training = Training::findOrFail($id);
        $course = Course::findOrFail($training->courseID);

        // ✅ جلب الطلاب المسجلين مع بيانات الطالب في استعلام واحد فقط (Eager Loading)
        $enrolled_students = Entrolment::with('student')
            ->where('courseID', $training->courseID)
            ->get();

        $training['course_name'] = $course->name; // نأخذ الاسم من المتغير $course الموجود بالفعل
        $training['studentCounter'] = $enrolled_students->count(); // عدّ المجموعة المحفوظة في الذاكرة

        return view('trainings.details', [
            'data' => $training, 
            'course' => $course, 
            'enrolled_students' => $enrolled_students // نرسل المتغير الجديد للفيو
        ]);
    }

    public function add_student($id)
    {
        $training = Training::findOrFail($id);
        $course = Course::findOrFail($training->courseID);
        $students = Student::select('id', 'name')->where('active', 1)->get();

        return view('trainings.add_student', [
            'data' => $training, 
            'course' => $course, 
            'students' => $students
        ]);
    }

    public function store_student($id, Request $request)
    {
        $training = Training::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'enrolements_date' => 'required|date',
        ]);

        // التحقق من عدم تكرار التسجيل
        $existingEnrollment = Entrolment::where('courseID', $training->courseID)
            ->where('studentID', $validated['student_id'])
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'الطالب مسجل بالفعل في هذه الدورة');
        }

        // إنشاء التسجيل الجديد
        $enrollment = new Entrolment;
        $enrollment->courseID = $training->courseID;
        $enrollment->studentID = $validated['student_id'];
        $enrollment->enrolements_date = $validated['enrolements_date'];
        $enrollment->save();

        return redirect()->route('trainings.details', $id)->with('success', 'تم إضافة الطالب بنجاح');
    }

    public function students_list($id)
    {
        $training = Training::findOrFail($id);
        $course = Course::findOrFail($training->courseID);

        $training['studentCounter'] = Entrolment::where('courseID', $training->courseID)->count();

        // جلب الطلاب المسجلين مع بيانات الطالب
        $enrolled_students = Entrolment::with('student')
            ->where('courseID', $training->courseID)
            ->get();

        return view('trainings.students_list', [
            'data' => $training, 
            'course' => $course, 
            'enrolled_students' => $enrolled_students
        ]);
    }

    public function remove_student(Request $request, $id, $student_id)
    {
        $training = Training::findOrFail($id);
        $deleted = Entrolment::where('courseID', $training->courseID)
            ->where('studentID', $student_id)
            ->delete();

        if($deleted === 0) {
          

        return redirect()->route('trainings.students_list', $id)->with('success', 'تم إزالة الطالب من الدورة بنجاح');
        }
  return redirect()->route('trainings.students_list', $id)->with('error', 'الطالب غير موجود في هذه الدورة'); 
    }
}