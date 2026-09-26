<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $training_data = Training::all();
        if(!empty($training_data)){
            foreach ($training_data as $info){
                $info->country_name = Country::where('id','=',$info->country_id)->value('name');
            }
        }
        return view('trainings.index',['training_data' => $training_data]);
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
    
    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

}
