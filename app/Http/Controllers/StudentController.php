<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::with('country')->get();
        // if(!empty($student))
        //     {
        //         foreach($student as $info){
        //             $info->countries::where('id','=',$info->country_id)->value('name'); // collection from country table 
        //         }
        //     }
        return view('students.index',['student' => $student]);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
        {

        }

    public function destroy()
    {

    }
    
}
