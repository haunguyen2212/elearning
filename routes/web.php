<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;


Route::get('/', [Front\HomeController::class, 'index'])->middleware('isLogin')->name('home');
Route::get('detail/{id}', [Front\HomeController::class, 'detail'])->middleware('isLogin')->name('course.detail');
Route::get('contact', [Front\ContactController::class, 'index'])->middleware('isLogin')->name('contact.index');
Route::get('profile', [Front\ProfileController::class, 'index'])->middleware('isLogin')->name('profile.index');

Route::get('login', [Front\LoginController::class, 'index'])->name('login');
Route::post('login', [Front\LoginController::class, 'checkLogin'])->name('login.check');
Route::get('logout', [Front\LoginController::class, 'logout'])->name('logout');
Route::get('admin/login', [Admin\LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [Admin\LoginController::class, 'checkLogin'])->name('admin.login.check');

Route::group(['prefix' => 'course', 'middleware' => 'isStudent'], function(){
    Route::get('enrol/{id}/', [Front\HomeController::class, 'enrol'])->name('course.enrol');
    Route::get('view/{id}', [Front\CourseStudentController::class, 'index'])->name('course.view.student');
});

Route::group(['middleware' => 'isStudent', 'as' => 'student.'], function(){
    Route::get('course-detail/{course_id}/exercise/{id}', [Front\ExerciseStudentController::class, 'index'])->name('exercise.index');
    Route::post('course-detail/{course_id}/exercise/{id}/upload', [Front\ExerciseStudentController::class, 'upload'])->name('exercise.upload');
    Route::delete('course-detail/{course_id}/exercise/{id}/delete', [Front\ExerciseStudentController::class, 'delete'])->name('exercise.delete');
    Route::get('course-detail/{course_id}/quiz/{id}', [Front\QuizStudentController::class, 'index'])->name('quiz.index');
    Route::get('profile/student/edit', [Front\ProfileController::class, 'editProfileStudent'])->name('profile.edit');
    Route::patch('profile/student/edit', [Front\ProfileController::class, 'updateProfileStudent'])->name('profile.update');
    Route::patch('profile/student/password/update', [Front\ProfileController::class, 'changePasswordStudent'])->name('profile.change_password');
    Route::get('exam/{id}', [Front\QuizStudentController::class, 'exam'])->name('exam.index');
    Route::post('quiz/{id}/check-password', [Front\QuizStudentController::class, 'checkPassword'])->name('exam.check_password');
    Route::post('exam/{id}/choose_question', [Front\QuizStudentController::class, 'chooseQuestion'])->name('exam.choose_question');
    Route::get('exam/{id}/result', [Front\QuizStudentController::class, 'result'])->name('exam.result');
    Route::get('exam/{id}/review', [Front\QuizStudentController::class, 'review'])->name('exam.review');
    Route::get('exam/{id}/submit', [Front\QuizStudentController::class, 'submit'])->name('exam.submit');
    Route::get('score', [Front\ScoreStudentController::class, 'index'])->name('score.index');
});

