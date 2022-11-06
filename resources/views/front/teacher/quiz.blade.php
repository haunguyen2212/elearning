@extends('template.master_layout')

@section('title', 'Bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.teacher', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">Thi trắc nghiệm</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.css') }}" />
@endsection

@section('right')
    @if (isset($listStudent))
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Danh sách học sinh</h5>
                <ul class="list-item ps-0 mb-0">
                    @foreach ($listStudent as $student)
                        <div class="d-flex justify-content-between student-name-wrap">
                        <div class="student-name">
                            <a href="{{ route('course.view.student_information', [$course->id, $student->id]) }}">
                            @if ($student->active == 1)
                                <i class="bi bi-person"></i>
                            @else
                                <i class="bi bi-person-x"></i>
                            @endif
                            {{ $student->username .' - '. $student->name }}
                            </a>
                        </div>
                        <div class="student-control">
                            <i class="bi bi-dash-circle delete-student" 
                                data-bs-toggle="modal" 
                                data-bs-target="#ModalDeleteStudent" 
                                data-url="{{ route('course.teacher.delete_student', ['course_id' => $course->id, 'student_id' => $student->id]) }}"
                                title="Xóa khỏi khóa học"></i>
                        </div>
                        </div>
                    @endforeach
                </ul> 
            </div>
        </div>
    </div>
    @include('front.teacher.modal.delete_student')            
    @endif
@endsection

@section('content')
<div class="card">
    <div class="card-body px-4">
        <div class="card-title mb-0">{{ $quiz->name }}</div>
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div>
                        <strong class="text-main">Thời gian mở đề: </strong>
                        <span>{{ date('d/m/Y H:i', strtotime($quiz->start_time)) }} - {{ date('d/m/Y H:i', strtotime($quiz->end_time)) }}</span>
                    </div>
                    <div>
                        <strong class="text-main">Thời gian làm bài: </strong>
                        <span class="fw-bold" style="color: #dc3545">{{ $quiz->duration }} phút</span>
                    </div>
                    <div>
                        <strong class="text-main">Mật khẩu: </strong>
                        <span>{{ $quiz->password }}</span>
                    </div>
                    <div>
                        <strong class="text-main">Lượt thi tối đa: </strong>
                        <span class="fw-bold">{{ $quiz->maximum }}</span>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center my-3">
                    <button class="btn-slide03 mx-1 delete-quiz" data-url="{{ route('teacher.quiz.delete', $quiz->id) }}" data-bs-toggle="modal" data-bs-target="#ModalDeleteQuiz">Xoá bài thi</button>
                    <button class="btn-slide05 mx-1 edit-quiz" data-url="{{ route('teacher.quiz.edit', $quiz->id) }}" data-bs-toggle="modal" data-bs-target="#ModalEditQuiz">Sửa bài thi</button>
                    <a href="{{ route('course.view.teacher', $course->id) }}" class="btn-slide01 mx-1">Về khóa học</a>
               </div>
            </div>
        </div>
    </div>
</div>
@include('front.teacher.modal.delete_quiz')
@include('front.teacher.modal.edit_quiz')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.js') }}" ></script>
    <script>
        var url_back = window.location.href;
        var url_previous = '{{ route('course.view.teacher', $course->id) }}';
    </script>
    <script>
        $('#start_time_quiz_edit, #end_time_quiz_edit').datetimepicker({
            format: 'd-m-Y H:i',
            step: 30
        });
    </script>
    <script src="{{ asset('frontend/assets/js/course/teacher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/quiz/teacher.js') }}"></script>
@endsection