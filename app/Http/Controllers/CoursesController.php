<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseValidationRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $course = Course::all();
        return view('courses.index',compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CreateCourseValidationRequest $request)
    {

        // validate if the course has been registered before 
        $exists = Course::where('name','=',$request->name)->exists();

        if($exists>0){
            return redirect()->back()->with(['error' => 'الكورس مسجل مسبقا']);
        }
        $course = new Course();

        $course->name = $request->name;
        $course->link = $request->link;
        $course->active = $request->active;

        $course->save();

        return redirect()->route('courses.index')->with(['success' => 'تم اضافة الكورس بنجاح'])->withInput();
    }

    public function edit($id){
        $data = Course::findOrFail($id);

        if(empty($data)){
            return redirect()->route('courses.index')->with(['error'=>'غير قادر على الوصول']);
        }

        return view('courses.edit',['data' => $data]);
    }

    public function update($id,CreateCourseValidationRequest $request)
    {
        $course = Course::findOrFail($id);

        if(empty($course)){
            return redirect()->route('courses.index')->with(['error' => 'غير قادر على الوصول']);
        }
        $course['name'] = $request->name;
        $course['link'] = $request->link;
        $course['active'] = $request->active ?? 1;

        $course->save();

        return redirect()->route('courses.index')->with(['success' => 'تم التحديث']);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if(empty($course))
            {
                return redirect()->route('courses.index')->with(['error' => 'غير قادر على الوصول']);
            }
            $course->delete();
            return redirect()->route('courses.index')->with(['success' => 'تم الحذف']);
    }

    public function show($id)
    {
    $course = Course::findOrFail($id);
        return view('courses.index',compact('course'));
    }

}
