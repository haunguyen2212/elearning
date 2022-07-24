<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [Admin\HomeController::class, 'index'])->name('admin.home');
    Route::resource('student', Admin\StudentController::class);
    Route::get('student/{id}/password', [Admin\StudentController::class, 'editPassword'])->name('student.pass.edit');
    Route::patch('student/{id}/password', [Admin\StudentController::class, 'updatePassword'])->name('student.pass.update');
    Route::resource('teacher', Admin\TeacherController::class);
    Route::get('teacher/{id}/password', [Admin\TeacherController::class, 'editPassword'])->name('teacher.pass.edit');
    Route::patch('teacher/{id}/password', [Admin\TeacherController::class, 'updatePassword'])->name('teacher.pass.update');
    Route::get('model', function(){
        return \App\Models\Teacher::find(1);
    });
});
