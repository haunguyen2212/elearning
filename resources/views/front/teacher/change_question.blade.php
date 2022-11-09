@extends('template.master')

@section('title', 'Chọn câu hỏi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.teacher', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher.quiz.index',[$course->id, $quiz->id]) }}">Thi trắc nghiệm</a></li>
    <li class="breadcrumb-item active">Chọn câu hỏi</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            @if (session('message'))
                <div class="alert alert-message alert-dismissible fade show" role="alert">
                    <div class="text-main"><i class="bi bi-exclamation-circle"></i> {{ session('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <div class="bd-highlight">
                    <div class="card-title mb-0">Chọn câu hỏi</div>
                 </div>
                 <div class="bd-highlight d-flex" style="gap: 10px">
                    <div class="text-main mb-0">
                       <a href="" class="btn-slide02"><i class="bi bi-gear"></i>&nbsp; Quản lý câu hỏi</a> 
                    </div>
                 </div>
            </div>
            
            <div class="card-content">
                @if (isset($questions) && $questions->count() > 0)
                <form id="frm-choose-question" action="">
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
                                        <td class="ps-3">
                                            <input type="checkbox" name="question_check[]" value="{{ $question->id }}" {{ in_array($question->id, $question_details) ? 'checked' : '' }}>
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
                </form>
                @endif
            </div>
            <div class="d-flex justify-content-center my-3">
                <button type="button" class="btn-slide01 save-change" data-url="{{ route('teacher.quiz.save.question', [$course->id, $quiz->id]) }}">Lưu kết quả (<span class="count-question">{{ count($question_details) }}</span>)</button> 
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/assets/js/quiz/question.js') }}"></script>
@endsection