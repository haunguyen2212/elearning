@extends('template.master')

@section('title', 'Bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.teacher', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">Thi trắc nghiệm</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.css') }}" />
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
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <div class="text-main">
                               <h5 class="fw-bold mb-0">Câu hỏi bài thi</h5> 
                            </div>
                         </div>
                         <div class="bd-highlight">
                            <div class="text-main mb-0">
                               <button type="button" class="btn-slide02"><i class="bi bi-gear"></i>&nbsp; Thay đổi câu hỏi</button> 
                            </div>
                         </div>
                    </div>
                    @if (isset($questions) && $questions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover custom-question" style="min-width: 800px">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th width="30%">Câu hỏi</th>
                                        <th width="15%">Đáp án A</th>
                                        <th width="15%">Đáp án B</th>
                                        <th width="15%">Đáp án C</th>
                                        <th width="15%">Đáp án D</th>
                                        <th width="5%">Đáp án</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $key  => $question)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {!! $question->question !!}
                                                @if (!empty($question->image))
                                                    <img class="mt-2" src="{{ asset('backend/assets/img/question/'.$question->image) }}" alt="image" style="max-width: 120px">
                                                @endif 
                                            </td>
                                            <td>{!! $question->answer_a !!}</td>
                                            <td>{!! $question->answer_b !!}</td>
                                            <td>{!! $question->answer_c !!}</td>
                                            <td>{!! $question->answer_d !!}</td>
                                            <td>
                                                <span class="fw-bold">
                                                    @switch($question->correct_answer)
                                                        @case(1)
                                                            A
                                                            @break
                                                        @case(2)
                                                            B
                                                            @break
                                                        @case(3)
                                                            C
                                                            @break
                                                        @case(4)
                                                            D
                                                            @break
                                                    @endswitch
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
    <script src="{{ asset('frontend/assets/js/quiz/teacher.js') }}"></script>
@endsection