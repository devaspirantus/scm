<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;

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
        $countries = Country::select("id","name")->where('active',1)->get();
        return view('students.create',['countries' => $countries]);
    }

    public function store(StudentRequest $request)
    {
                // validate if the course has been registered before 
        $exists = Student::where('name','=',$request->name)->exists();

        if($exists>0){
            return redirect()->back()->with(['error' => 'الطالب مسجل مسبقا']);
        }
        $student = new Student();

        $student->name = $request->name;
        $student->country_id = $request->country_id;
        $student->phone = $request->phone;
        $student->nationalID = $request->nationalID;
        $student->address = $request->address;
        $student->notes = $request->notes;
        $student->active = $request->active;

        if($request->has('photo'))
            {
                $image = $request->photo;
                $extension = strtolower($image->extension());
                $filename = time().rand(1,1000).".".$extension;
                $image->move('uploads',$filename);
                $student->image = $filename;
            }
        $student->save();

        return redirect()->route('students.index')->with(['success' => 'تم اضافة الطالب بنجاح'])->withInput();
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
