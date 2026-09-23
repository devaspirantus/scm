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
        
    }

}
