@extends('template.master')

@section('title', 'Chi tiết câu hỏi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.question.index') }}">Câu hỏi trắc nghiệm</a></li>
    <li class="breadcrumb-item"> <a href="{{ route('teacher.question.view', $subject->id) }}"> Danh sách câu hỏi</a></li>
    <li class="breadcrumb-item active">Chi tiết</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            <h5 class="card-title">Chi tiết câu hỏi</h5>
            <div class="row">
                <div class="col-12 col-md-3">
                    <strong class="text-main">Môn học: </strong>
                    <span>{{ $question->subject_name }}</span>
                </div>
                <div class="col-12 col-md-3">
                    <strong class="text-main">Mức độ: </strong>
                    <span>
                        @switch($question->level)
                            @case(1)
                                Dễ
                                @break
                            @case(2)
                                Trung bình
                                @break
                            @case(3)
                                Khó
                                @break
                        @endswitch
                    </span>
                </div>
                <div class="col-12 col-md-3">
                    <strong class="text-main">Loại: </strong>
                    <span>
                        @switch($question->shared)
                            @case(0)
                                Riêng
                                @break
                            @case(1)
                                Chung
                                @break
                        @endswitch
                    </span>
                </div>
                <div class="col-12 mt-2 question-style">
                    <div class="question-text">
                        <strong class="text-main">Câu hỏi:&nbsp;</strong>
                        <span>{!! $question->question !!}</span>
                    </div>
                    @if (!empty($question->image))
                        <div class="question-image">
                            <img src="{{ asset('backend/assets/img/question/'.$question->image) }}" alt="image">
                        </div>
                    @endif
                    <div class="question-text">
                        <span>A.&nbsp; </span>
                        <span>{!! $question->answer_a !!}</span>
                    </div>
                    <div class="question-text">
                        <span>B.&nbsp; </span>
                        <span>{!! $question->answer_b !!}</span>
                    </div>
                    @if(!empty($question->answer_c))
                        <div class="question-text">
                            <span>C.&nbsp; </span>
                            <span>{!! $question->answer_c !!}</span>
                        </div>
                    @endif

                    @if (!empty($question->answer_d))
                        <div class="question-text">
                            <span>D.&nbsp; </span>
                            <span>{!! $question->answer_d !!}</span>
                        </div>
                    @endif
                    
                    <div class="mt-2">
                        <strong class="text-main">Đáp án đúng: </strong>
                        <span style="color: #dc3545">
                            <strong>
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
                            </strong> 
                        </span>
                    </div>
                    <div class="question-text">
                        <strong class="text-main">Giải thích:&nbsp; </strong>
                        <span>{!! $question->explain !!}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-center my-3">
                        <button class="btn-slide03 mx-1 btn-delete" 
                            data-url="{{ route('teacher.question.destroy',[$subject->id, $question->id]) }}" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ModalDeleteQuestion"
                        >
                            Xoá câu hỏi
                        </button>
                        <button class="btn-slide05 mx-1 btn-edit" 
                            data-url="{{ route('teacher.question.edit', [$subject->id, $question->id]) }}" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ModalEditQuestion"
                        >
                            Sửa câu hỏi
                        </button>
                        <a href="{{ route('teacher.question.view', $subject->id) }}" class="btn-slide01 mx-1">Về trang trước</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.teacher.modal.delete_question')
    @include('front.teacher.modal.edit_question')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('question_edit');
        CKEDITOR.replace('answer_a_edit');
        CKEDITOR.replace('answer_b_edit');
        CKEDITOR.replace('answer_c_edit');
        CKEDITOR.replace('answer_d_edit');
        CKEDITOR.replace('explain_edit');
        var url_back = '{{ route('teacher.question.view', $subject->id) }}';
        var url_img = '{{ asset('backend/assets/img/question') }}';
    </script>
    <script src="{{ asset('frontend/assets/js/question/teacher.js') }}"></script>
@endsection