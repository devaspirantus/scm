<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResFlightController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('admin.home');
})->name('home');

Route::get('/',[HomeController::class,'index'])->name('home');

// Route::get('courses',[CoursesController::class,'index'])->name('courses.index');
// Route::get('create_course',[CoursesController::class,'create'])->name('courses.create');
// Route::post('store_courses',[CoursesController::class,'store'])->name('courses.store');
// Route::get('edit/{id}',[CoursesController::class,'edit'])->name('courses.edit');
// Route::post('update/{id}',[CoursesController::class,'update'])->name('courses.update');
// Route::get('destroy/{id}',[CoursesController::class,'destroy'])->name('courses.destroy');
Route::resource('courses',CoursesController::class)->except(['show']);
// Route::get('students',[StudentController::class,'index'])->name('students.index');
// Route::get('create_student',[StudentController::class,'create'])->name('students.create');
// Route::post('store_student',[StudentController::class,'store'])->name('students.store');
// Route::get('edit/{id}',[StudentController::class,'edit'])->name('students.edit');
// Route::post('update/{id}',[StudentController::class,'update'])->name('students.update');
// Route::get('destroy/{id}',[StudentController::class,'destroy'])->name('students.destroy');

Route::resource('students',StudentController::class)->except(['show']);
Route::resource('flights',ResFlightController::class);
Route::resource('countries',CountriesController::class);
