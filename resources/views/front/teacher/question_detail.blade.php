@extends('template.master')

@section('title', 'Câu hỏi trắc nghiệm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.question.index') }}">Câu hỏi trắc nghiệm</a></li>
    <li class="breadcrumb-item active">Danh sách câu hỏi</li>
@endsection

@section('content')
    <div class="card main-card">
        <div class="card-body px-4">
            <div class="card-title mb-0">Câu hỏi môn {{ $subject->name }}</div>
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table table-hover custom-question" style="min-width: 800px">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="30%">Câu hỏi</th>
                                <th width="12.5%">Đáp án A</th>
                                <th width="12.5%">Đáp án B</th>
                                <th width="12.5%">Đáp án C</th>
                                <th width="12.5%">Đáp án D</th>
                                <th width="7.5%">Đáp án</th>
                                <th width="7.5%">Độ khó</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key  => $question)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
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
                                        <span class="fw-bold ps-3">
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
                                    <td>
                                        @switch($question->level)
                                          @case(1)
                                            <span class="fw-bold" style="color: #f8c309">Dễ</span>
                                            @break
                                          @case(2)
                                            <span class="fw-bold" style="color: #117c47">Trung bình</span>
                                            @break
                                          @case(3)
                                            <span class="fw-bold" style="color: #ff3535">Khó</span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">{{ $questions->links() }}</div>
            </div>
        </div>
    </div>
@endsection