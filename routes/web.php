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

