@extends('template.master_layout')

@section('title', 'Điểm số')

@section('breadcrumb')
    <li class="breadcrumb-item active">Điểm số</li>
@endsection

@section('content')
<div class="card main-card">
    <div class="card-body px-4">
        <div class="card-title mb-0">Điểm số</div>
        <div class="card-content">
            @if (isset($exercises) && $exercises->count() > 0)
                <div class="fw-bold text-main text-decoration-underline">Điểm bài tập :</div>
                <ul>
                    @foreach ($exercises as $exercise)
                        <li><a class="text-dark" href="{{ route('student.exercise.index', ['course_id' => $exercise->course_id, 'id' => $exercise->exercise_id]) }}">+ {{ $exercise->course_name }} - <span>{{ $exercise->exercise_name }}: </span> <span class="fw-bold text-danger">{{ $exercise->score }}</span></a></li>
                    @endforeach
                </ul>
            @endif
            @if (isset($quizzes) && $quizzes->count() > 0)
                <div class="fw-bold text-main text-decoration-underline">Điểm bài tập :</div>
                <ul>
                    @foreach ($quizzes as $quiz)
                        <li><a class="text-dark" href="{{ route('student.quiz.index', ['course_id' => $quiz->course_id, 'id' => $quiz->quiz_id]) }}">+ {{ $quiz->course_name }} - <span>{{ $quiz->quiz_name }}: </span> <span class="fw-bold text-danger">{{ $quiz->score }}</span></a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection