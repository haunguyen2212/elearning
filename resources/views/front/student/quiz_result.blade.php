@extends('template.master')

@section('title', 'Thi trắc nghiệm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.student',$course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item"> <a href="{{ route('student.quiz.index', ['course_id' => $course->id, 'id' => $quiz->id]) }}">{{ $quiz->name }}</a></li>
    <li class="breadcrumb-item active">Kết quả</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-exam text-white fw-bold text-center">{{ auth()->guard('student')->user()->username }} - {{ auth()->guard('student')->user()->name }}</div>
                <div class="card-text">
                    <div id="tg">
                        <div id="time-header">Kết quả bài làm</div>
                        <div class="container-fluid px-5" id="list-answer">
                            @foreach($id_questions as $key => $value)
                                <div class="btn btn-sm btn-answer {{ $value->choose == $value->correct ? 'btn-true' : 'btn-false' }}">
                                    {{ $key + 1 }}
                                </div>
                            @endforeach					
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card mb-3">
                <div class="card-header bg-exam text-white fw-bold">{{ $quiz->name }}</div>
                <div class="card-text mt-2">
                    @foreach ($questions as $key => $question)
                    <form class="question-exam">
                        <div class="row form-question" style="margin: 0 50px 0 10px">
                            <div class="col-12 question-text">
                                <span class="fw-bold text-main">Câu {{ ($questions->currentPage() - 1) * $questions->perPage() +  $key + 1 }}: </span>&nbsp;{!! $question->question !!}
                            </div>
                            <div class="col-12 question-text {{ $question->correct_answer == 1 ? 'correct-answer' : '' }}">
                                <label><input type="radio" name="question-{{ $question->id }}" value="1" {{ $question->choose == 1 ? 'checked' : '' }} style="vertical-align: middle" disabled>&nbsp;{!! $question->answer_a !!}</label>
                            </div>
                            <div class="col-12 question-text {{ $question->correct_answer == 2 ? 'correct-answer' : '' }}">
                                <label><input type="radio" name="question-{{ $question->id }}" value="2" {{ $question->choose == 2 ? 'checked' : '' }} style="vertical-align: middle" disabled>&nbsp;{!! $question->answer_b !!}</label>
                            </div>
                            @if (isset($question->answer_c))
                                <div class="col-12 question-text {{ $question->correct_answer == 3 ? 'correct-answer' : '' }}">
                                    <label><input type="radio" name="question-{{ $question->id }}" value="3" {{ $question->choose == 3 ? 'checked' : '' }} style="vertical-align: middle" disabled>&nbsp;{!! $question->answer_c !!}</label>
                                </div>
                            @endif
                            @if (isset($question->answer_d))
                                <div class="col-12 question-text {{ $question->correct_answer == 4 ? 'correct-answer' : '' }}">
                                    <label><input type="radio" name="question-{{ $question->id }}" value="4" {{ $question->choose == 4 ? 'checked' : '' }} style="vertical-align: middle" disabled>&nbsp;{!! $question->answer_d !!}</label>
                                </div>
                            @endif
                            @if (isset($question->explain))
                                <div class="col-12 question-text my-2 py-2 explain">
                                    <span class="fw-bold text-main">Giải thích: </span>&nbsp;{!! $question->explain !!}
                                </div>
                            @endif
                        </div>
                    </form>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/exam.css') }}">
@endsection