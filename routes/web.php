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
    Route::get('view/{id}', [Front\CourseStudentController::class, 'index'])->name('course.index');
});

Route::group(['prefix' => 'teacher', 'middleware' => 'isTeacher'], function(){
    Route::get('/', [Front\TeacherHomeController::class, 'index'])->name('teacher.home');
    Route::get('registration', [Front\RoomRegistrationController::class, 'create'])->name('teacher.registration.create');
    Route::post('registration', [Front\RoomRegistrationController::class, 'store'])->name('teacher.registration.store');
});

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

    Route::get('room-registration', [Admin\ScheduleController::class, 'index'])->name('schedule.list');
    Route::get('schedule/create', [Admin\ScheduleController::class, 'create'])->name('schedule.create');
    Route::get('schedule/show', [Admin\ScheduleController::class, 'error'])->name('schedule.error');
    Route::post('schedule/show', [Admin\ScheduleController::class, 'main'])->name('schedule.handle');
    Route::post('download/docx', [Admin\ScheduleController::class, 'printDocx'])->name('schedule.download.docx');
    Route::get('registration/create', [Admin\ScheduleController::class, 'createRegistration'])->name('admin.registration.create');
    Route::post('registration/store', [Admin\ScheduleController::class, 'storeRegistration'])->name('admin.registration.store');
});
