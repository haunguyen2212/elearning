<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;


Route::get('/', [Front\HomeController::class, 'index'])->middleware('isLogin')->name('home');
Route::get('detail/{id}', [Front\HomeController::class, 'detail'])->name('course.detail');

Route::get('login', [Front\LoginController::class, 'index'])->name('login');
Route::post('login', [Front\LoginController::class, 'checkLogin'])->name('login.check');
Route::get('logout', [Front\LoginController::class, 'logout'])->name('logout');
Route::get('admin/login', [Admin\LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [Admin\LoginController::class, 'checkLogin'])->name('admin.login.check');

Route::group(['prefix' => 'course', 'middleware' => 'isStudent'], function(){
    Route::get('enrol/{id}/', [Front\HomeController::class, 'enrol'])->name('course.enrol');
    Route::get('view/{id}', [Front\CourseStudentController::class, 'index'])->name('course.view.student');
});

Route::group(['prefix' => 'teacher', 'middleware' => 'isTeacher'], function(){
    Route::get('/', [Front\TeacherHomeController::class, 'index'])->name('teacher.home');
    Route::get('registration', [Front\RoomRegistrationController::class, 'create'])->name('teacher.registration.create');
    Route::post('registration', [Front\RoomRegistrationController::class, 'store'])->name('teacher.registration.store');
    Route::get('registration/{id}/edit', [Front\RoomRegistrationController::class, 'edit'])->name('teacher.registration.edit');
    Route::put('registration/{id}/update', [Front\RoomRegistrationController::class, 'update'])->name('teacher.registration.update');
    Route::delete('registration/{id}/delete', [Front\RoomRegistrationController::class, 'destroy'])->name('teacher.registration.destroy');
    Route::get('course/{id}/view', [Front\CourseTeacherController::class, 'index'])->name('course.view.teacher');
    Route::patch('topic/{id}/pin', [Front\CourseTeacherController::class, 'pinTopic'])->name('course.pin.teacher');
    Route::patch('topic/{id}/unpin', [Front\CourseTeacherController::class, 'unpinTopic'])->name('course.unpin.teacher');
    Route::patch('topic/{id}/show', [Front\CourseTeacherController::class, 'showTopic'])->name('course.show.teacher');
    Route::patch('topic/{id}/hide', [Front\CourseTeacherController::class, 'hideTopic'])->name('course.hide.teacher');
    Route::post('course/{id}/store', [Front\CourseTeacherController::class, 'storeTopic'])->name('course.topic.store');
});

