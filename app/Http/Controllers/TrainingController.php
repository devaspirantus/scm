<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingRequest;
use App\Models\Country;
use App\Models\Course;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $training_data = Training::all();
        if(!empty($training_data)){
            foreach ($training_data as $info){
                $info->course_name = Country::where('id','=',$info->course)->value('name');
            }
        }
        return view('trainings.index',['training_data' => $training_data]);
    }

    public function create()
    {
        $courses = Course::select('id','name')->where('active',1)->get();

        return view('trainings.create',['courses' => $courses]);
    }

    public function store(TrainingRequest $request)
    {
        $student = new Training();
        $student->courseID = $request->courseID;
        $student->start_date = $request->start_date;
        $student->end_date = $request->end_date;
        $student->price = $request->price;
        $student->notes = $request->notes;
        $student->save();

        return redirect()->route('trainings.index')->with(['success' => 'تم اضافة البيانات']);
    }

    public function edit($id)
    {
        $data = Training::find($id);

        if(empty($data))
            {
                return redirect()->route('trainings.index')->with(['error' => 'cant']);
            }

            $courses = Course::select('id','name')->where('active',1)->get();

            return view('trainings.edit',['data' => $data,'courses' => $courses]);
    }
    
    public function update($id, TrainingRequest $request)
    {
        $student = Training::find($id);

        if(empty($training_data))
            {
                return redirect()->route('trainings.index')->with(['error' => 'failed']);
            }
                 $student->courseID = $request->courseID;
        $student->start_date = $request->start_date;
        $student->end_date = $request->end_date;
        $student->price = $request->price;
        $student->notes = $request->notes;
        $student->save();
         return redirect()->route('trainings.index')->with(['success' => 'OK']);
    }

    public function destroy($id)
    {
              $student = Training::find($id);

        if(empty($training_data))
            {
                return redirect()->route('trainings.index')->with(['error' => 'failed']);
            }
            $student->delete();
         return redirect()->route('trainings.index')->with(['success' => 'OK']);


    }

}
