<?php

use App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;

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
    Route::post('topic/{id}/upload', [Front\CourseTeacherController::class, 'uploadDocument'])->name('topic.document.upload');
    Route::delete('topic/{id}/delete', [Front\CourseTeacherController::class, 'deleteTopic'])->name('topic.delete');
    Route::get('topic/{id}/edit', [Front\CourseTeacherController::class, 'editTopic'])->name('topic.edit');
    Route::patch('topic/{id}/update', [Front\CourseTeacherController::class, 'updateTopic'])->name('topic.update');
    Route::patch('topic-document/{id}/show', [Front\CourseTeacherController::class, 'showDocument'])->name('topic_document.show');
    Route::patch('topic-document/{id}/hide', [Front\CourseTeacherController::class, 'hideDocument'])->name('topic_document.hide');
    Route::delete('topic-document/{id}/delete', [Front\CourseTeacherController::class, 'deleteDocument'])->name('topic_document.delete');
});