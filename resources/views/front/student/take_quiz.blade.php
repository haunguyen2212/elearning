@extends('template.master')

@section('title', 'Làm bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.student', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.quiz.index', ['course_id' => $course->id, 'id' => $quiz->id]) }}">{{ $quiz->name }}</a></li>
    <li class="breadcrumb-item active">Làm bài thi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-exam text-white fw-bold text-center">{{ auth()->guard('student')->user()->username }} - {{ auth()->guard('student')->user()->name }}</div>
                <div class="card-text">
                    <div id="tg">
                        <div id="time-header">THỜI GIAN LÀM BÀI</div>
                        <div id="count-down" class="fw-bold text-danger"></div>
                        <div class="container-fluid px-5" id="list-answer">
                            @foreach($id_questions as $key => $value)
                                <div id="ques-{{ $value->question_id }}" 
                                        class="btn btn-sm btn-answer {{ $value->choose != null ? 'question-checked' : '' }}" 
                                        onclick="goToQuestion({{ ceil(($key+1) / $questions->perPage()) }})"
                                        >
                                    {{ $key + 1 }}
                                </div>
                            @endforeach						
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="{{ route('student.exam.review', ['id' => $exam->id]) }}" class="btn btn-sm btn-quiz">Nộp bài</a>
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
                    <form id="form-question-{{ $question->id }}" class="question-exam" data-id="{{ $question->id }}">
                        <div class="row form-question" style="margin: 0 50px 0 10px">
                            <div class="col-12 question-text">
                                <span class="fw-bold text-danger">Câu {{ ($questions->currentPage() - 1) * $questions->perPage() +  $key + 1 }}: </span>&nbsp;{!! $question->question !!}
                            </div>
                            @if (!empty($question->image))
                                <div class="question-image">
                                    <img src="{{ asset('backend/assets/img/question/'.$question->image) }}" alt="image">
                                </div>
                            @endif
                            <div class="col-12 question-text">
                                <label><input type="radio" name="question-{{ $question->id }}" value="1" {{ $question->choose == 1 ? 'checked' : '' }} style="vertical-align: middle">&nbsp;{!! $question->answer_a !!}</label>
                            </div>
                            <div class="col-12 question-text">
                                <label><input type="radio" name="question-{{ $question->id }}" value="2" {{ $question->choose == 2 ? 'checked' : '' }} style="vertical-align: middle">&nbsp;{!! $question->answer_b !!}</label>
                            </div>
                            @if (isset($question->answer_c))
                                <div class="col-12 question-text">
                                    <label><input type="radio" name="question-{{ $question->id }}" value="3" {{ $question->choose == 3 ? 'checked' : '' }} style="vertical-align: middle">&nbsp;{!! $question->answer_c !!}</label>
                                </div>
                            @endif
                            @if (isset($question->answer_d))
                                <div class="col-12 question-text">
                                    <label><input type="radio" name="question-{{ $question->id }}" value="4" {{ $question->choose == 4 ? 'checked' : '' }} style="vertical-align: middle">&nbsp;{!! $question->answer_d !!}</label>
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

@section('script')
<script>
    var url_submit_question = '{{ route('student.exam.choose_question', ['id' => $take_quiz->id]) }}';
    function goToQuestion(number){
        if(number == {{ $questions->currentPage() }}) return;
        window.location.href = window.location.origin + window.location.pathname+'?page='+number;
    }

    function countDown(number){
        number--;
        var hour = Math.floor(number/3600);
        var minute = Math.floor((number/60)%60);
        var second = Math.floor(number%60);
        if (hour<10) hour = '0'+hour;
        if (minute<10) minute = '0'+minute;
        if (second<10) second = '0'+second;
        
        $('#count-down').html(hour+":"+minute+":"+second);
        myVar = setTimeout("countDown("+number+")",1000);
        if (number<1) {
            clearTimeout(myVar);
            checkResult();
        }

    }

    function checkResult(){
        window.location.href = '{{ route('student.exam.submit', ['id' => $exam->id]) }}';
    }

    countDown({{ $diff }});
</script>
<script src="{{ asset('frontend/assets/js/quiz/take_quiz.js') }}"></script>
@endsection