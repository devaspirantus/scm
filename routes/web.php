<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResFlightController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingController;

Route::get('/', function () {
    return view('admin.home');
})->name('home');

Route::get('/',[HomeController::class,'index'])->name('home');
Route::resource('trainings', TrainingController::class)->except(['show']);
Route::resource('courses',CoursesController::class)->except(['show']);
Route::resource('students',StudentController::class)->except(['show']);
Route::resource('flights',ResFlightController::class);
Route::resource('countries',CountriesController::class);
Route::get('/details/{id}',[TrainingController::class,'details'])->name('trainings.details');

Route::get('/add_student/{id}',[TrainingController::class,'add_student'])->name('trainings.add_student');
Route::post('/store_student/{id}',[TrainingController::class,'store_student'])->name('trainings.store_student');
Route::get('/students_list/{id}',[TrainingController::class,'students_list'])->name('trainings.students_list');
Route::delete('/trainings/{id}/remove_student/{student_id}', [TrainingController::class, 'remove_student'])->name('trainings.remove_student');
Route::post('/ajax_search_student',[StudentController::class,'ajax_search_student'])->name('students.ajax_search_student');