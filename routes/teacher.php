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
    Route::get('course/{id}/change_enrol/{value}', [Front\CourseTeacherController::class, 'changeEnrol'])->name('course.enrol.change');
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
    Route::get('topic-document/{id}/rename', [Front\CourseTeacherController::class, 'editRenameDocument'])->name('topic_document.rename.get');
    Route::patch('topic-document/{id}/rename', [Front\CourseTeacherController::class, 'updateRenameDocument'])->name('topic_document.rename.patch');
    Route::post('topic/{id}/store-link', [Front\CourseTeacherController::class, 'storeLink'])->name('topic.link.store');
    Route::get('course/{course_id}/student/{student_id}/delete', [Front\CourseTeacherController::class, 'confirmDeleteStudent'])->name('course.teacher.confirm_delete_student');
    Route::delete('course/{course_id}/student/{student_id}/delete', [Front\CourseTeacherController::class, 'deleteStudent'])->name('course.teacher.delete_student');
    Route::patch('course/{id}/notice/update', [Front\CourseTeacherController::class, 'updateNotice'])->name('course.notice.update');

    Route::group(['as' => 'teacher.exercise.'], function(){
        Route::post('topic/{topic_id}/exercise/create', [Front\ExerciseTeacherController::class, 'store'])->name('store');
        Route::get('course-detail/{course_id}/exercise/{id}', [Front\ExerciseTeacherController::class, 'index'])->name('index');
        Route::post('course-detail/{course_id}/exercise/{id}/upload', [Front\ExerciseTeacherController::class, 'upload'])->name('upload');
        Route::patch('exercise/{id}/hide', [Front\ExerciseTeacherController::class, 'hide'])->name('hide');
        Route::patch('exercise/{id}/show', [Front\ExerciseTeacherController::class, 'show'])->name('show');
        Route::get('exercise/{id}/edit', [Front\ExerciseTeacherController::class, 'edit'])->name('edit');
        Route::put('exercise/{id}/edit', [Front\ExerciseTeacherController::class, 'update'])->name('update');
        Route::delete('course-detail/{course_id}/exercise/{id}/delete', [Front\ExerciseTeacherController::class, 'delete'])->name('delete');
        Route::patch('exercise/{id}/student/{student_id}/update-score', [Front\ExerciseTeacherController::class, 'updateScore'])->name('score.update');
    });

    Route::group(['as' => 'teacher.quiz.'], function(){
        Route::get('course-detail/{course_id}/quiz/{id}', [Front\QuizTeacherController::class, 'index'])->name('index');
        Route::post('topic/{topic_id}/quiz/create', [Front\QuizTeacherController::class, 'store'])->name('store');
        Route::patch('quiz/{id}/hide', [Front\QuizTeacherController::class, 'hide'])->name('hide');
        Route::patch('quiz/{id}/show', [Front\QuizTeacherController::class, 'show'])->name('show');
        Route::delete('quiz/{id}/delete', [Front\QuizTeacherController::class, 'delete'])->name('delete');
        Route::get('quiz/{id}/edit', [Front\QuizTeacherController::class, 'edit'])->name('edit');
        Route::patch('quiz/{id}/edit', [Front\QuizTeacherController::class, 'update'])->name('update');
    });

    Route::delete('course-detail/{course_id}/exercise-document/{id}/delete', [Front\ExerciseTeacherController::class, 'deleteDocument'])->name('teacher.exercise_document.delete');
    
    Route::get('course/{course_id}/student-information/{student_id}', [Front\StudentInformationController::class, 'index'])->name('course.view.student_information');
});