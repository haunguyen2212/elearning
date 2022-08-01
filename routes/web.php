<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [Front\LoginController::class, 'index'])->name('login');
Route::post('login', [Front\LoginController::class, 'checkLogin'])->name('login.check');
Route::get('admin/login', [Admin\LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [Admin\LoginController::class, 'checkLogin'])->name('admin.login.check');

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function(){
    Route::get('logout', [Admin\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [Admin\HomeController::class, 'index'])->name('admin.home');
    
    Route::resource('student', Admin\StudentController::class);
    Route::get('student/{id}/password', [Admin\StudentController::class, 'editPassword'])->name('student.pass.edit');
    Route::patch('student/{id}/password', [Admin\StudentController::class, 'updatePassword'])->name('student.pass.update');
    Route::patch('student/{id}/lock', [Admin\StudentController::class, 'changeStatus'])->name('student.lock');
    Route::get('student/import/excel', [Admin\StudentController::class, 'createImport'])->name('student.import.create');
    Route::post('student/import/excel', [Admin\StudentController::class, 'storeImport'])->name('student.import.store');
    
    Route::resource('teacher', Admin\TeacherController::class);
    Route::get('teacher/{id}/password', [Admin\TeacherController::class, 'editPassword'])->name('teacher.pass.edit');
    Route::patch('teacher/{id}/password', [Admin\TeacherController::class, 'updatePassword'])->name('teacher.pass.update');
    Route::patch('teacher/{id}/lock', [Admin\TeacherController::class, 'changeStatus'])->name('teacher.lock');
    Route::get('teacher/import/excel', [Admin\TeacherController::class, 'createImport'])->name('teacher.import.create');
    Route::post('teacher/import/excel', [Admin\TeacherController::class, 'storeImport'])->name('teacher.import.store');

    Route::resource('class', Admin\ClassController::class);
    Route::get('class/{id}/homeroom_teacher/edit', [Admin\ClassController::class, 'editHomeroomTeacher'])->name('class.homeroomTeacher.edit');
    Route::patch('class/{id}/homeroom_teacher/update', [Admin\ClassController::class, 'updateHomeroomTeacher'])->name('class.homeroomTeacher.update');
    
    Route::resource('department', Admin\DepartmentController::class);
});

Route::get('model', function(){
    return \App\Models\Classes::find(2)->students;
});