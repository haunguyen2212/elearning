@extends('template.master')

@section('title', 'Làm bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.student', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.quiz.index', ['course_id' => $course->id, 'id' => $quiz->id]) }}">{{ $quiz->name }}</a></li>
    <li class="breadcrumb-item active">Làm bài thi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header bg-exam text-white fw-bold text-center">Danh sách câu trả lời</div>
                <div class="card-text">
                    <div class="mt-4" style="max-width: 250px; margin: 0 auto">
                        <table class="table table-bordered">
                            @foreach ($questions as $key => $question)
                                <tr>
                                    <td class="text-center fw-bold" style="width: 50%; background: rgb(209, 208, 208)">Câu {{ $key + 1 }}</td>
                                    <td class="text-center" style="width: 50%">
                                        @switch($question->choose)
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
                                            @default
                                                Chưa chọn
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                            
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mb-4">
                        <a class="btn btn-sm btn-success me-2" href="{{ route('student.exam.index', ['id' => $exam->id]) }}">Tiếp tục làm bài</a>
                        <a class="btn btn-sm btn-quiz" href="{{ route('student.exam.submit', ['id' => $exam->id]) }}">Nộp bài</a>
                    </div>
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
@endsection