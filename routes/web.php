<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResFlightController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;

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
Route::resource('courses',CoursesController::class);

Route::resource('flights',ResFlightController::class);
Route::resource('countries',CountriesController::class);
