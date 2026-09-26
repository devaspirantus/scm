<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;

class HomeController extends Controller
{
    public function index()
    {
        $username = Student::all();
        return view('admin.home',compact('username'));
    }
}
