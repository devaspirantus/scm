<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseValidationRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $data = Course::all();
        return view('courses.index',compact('data'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CreateCourseValidationRequest $request)
    {

        // validate if the course has been registered before 
        $counter = Course::where('name','=',$request->name)->count();

        if($counter>0){
            return redirect()->back()->with(['error' => 'الكورس مسجل مسبقا']);
        }
        $course = new Course();

        $course->name = $request->name;
        $course->active = $request->active;

        $course->save();

        return redirect()->route('courses.index')->with(['success' => 'تم اضافة الكورس بنجاح'])->withInput();
    }

}
