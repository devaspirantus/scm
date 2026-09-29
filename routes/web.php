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
