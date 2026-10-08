<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Country;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\General;

class StudentController extends Controller
{
    use General;
    public function index()
    {
        $d = $this->developer();
        $student = Student::with('country')->get();

        // if(!empty($student))
        //     {
        //         foreach($student as $info){
        //             $info->countries::where('id','=',$info->country_id)->value('name'); // collection from country table
        //         }
        //     }
        return  view('students.index', ['student' => $student, 'trait' => $d]);
    }

    public function create()
    {
        $countries = Country::select('id', 'name')->where('active', 1)->get();

        return view('students.create', ['countries' => $countries]);
    }

    public function store(StudentRequest $request)
    {
        // validate if the course has been registered before
        $exists = Student::where('name', '=', $request->name)->exists();

        if ($exists > 0) {
            return redirect()->back()->with(['error' => 'الطالب مسجل مسبقا']);
        }


        // ✅ 3. جلب البيانات التي تم التحقق منها بنجاح (مضمونة 100%)
        $validatedData = $request->validated();

        // ✅ 4. معالجة رفع الصورة إذا قام المستخدم برفعها
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('students', 'public');
        }
        Student::create($validatedData);

        return redirect()->route('students.index')->with(['success' => 'تم اضافة الطالب بنجاح'])->withInput();
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $countries = Country::select('id', 'name')->where('active', 1)->get();

        if (empty($student)) {
            return redirect()->route('students.index')->with(['error' => 'غير قادر على الوصول للمعلومة']);
        }

        return view('students.edit', ['student' => $student, 'countries' => $countries]);
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        // if (empty($student)) {
        //     return redirect()->route('students.index')->with(['error' => "غير قادر على الوصول للمعلومة"]);
        // }
        $validatedData = $request->validated();
        unset($validatedData['nationalID']);

        // معالجة الصورة الجديدة فقط إذا تم رفع واحدة
        if ($request->hasFile('photo')) {
            // حذف الصورة القديمة إن وجدت
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($validatedData);

        return redirect()->route('students.index')->with(['success' => 'تم تحديث معلومات الطالب']);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with(['success' => 'تم حذف معلومات الطالب']);
    }

    public function ajax_search_student(Request $request)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $name = trim($validated['name'] ?? '');
        $students = Student::with('country')
            ->when($name !== '', fn ($query) => $query->where('name', 'like', "%{$name}%"))
            ->get();

        return view('students.ajax_search_student', ['student' => $students]);
    }


}
