<?php

namespace App\Http\Controllers;

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

    }

    public function store()
    {

    }

}
