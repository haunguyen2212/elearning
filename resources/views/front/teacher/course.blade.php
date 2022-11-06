@extends('template.master_layout')

@section('title', 'Khoá học')

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $course->name }}</li>
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
            @if (session('err_exists_file'))
                <div class="alert alert-message alert-dismissible fade show" role="alert">
                    @foreach (session('err_exists_file') as $value)
                        <div><i class="bi bi-exclamation-circle"></i> {{ $value }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-message alert-dismissible fade show" role="alert">
                    <div class="text-main"><i class="bi bi-exclamation-circle"></i> {{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-message alert-dismissible fade show" role="alert">
                    <div><i class="bi bi-exclamation-circle"></i> {{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <div class="bd-highlight">
                    <div class="card-title mb-0">
                        <i class="bi bi-info-circle-fill"></i> Các thông báo
                        <i class="bi bi-chevron-double-right edit-course-notice" 
                            data-url="{{ route('course.notice.update', $course->id) }}" 
                            data-bs-toggle="modal"
                            data-bs-target="#ModalEditCourseNotice"
                            title="Chỉnh sửa"
                            style="cursor: pointer"></i>
                    </div>
                 </div>
                 <div class="bd-highlight">
                        @if ($course->is_enrol == 1)
                            <button class="btn btn-sm rounded-circle bg-main btn-change-enrol" data-url="{{ route('course.enrol.change', ['id' => $course->id, 'value' => 0]) }}">
                                <i class="bi bi-unlock-fill" title="Cho phép ghi danh"></i>
                            </button>
                        @else
                            <button class="btn btn-sm rounded-circle bg-main btn-change-enrol" data-url="{{ route('course.enrol.change', ['id' => $course->id, 'value' => 1]) }}">
                                <i class="bi bi-lock-fill" title="Không cho phép ghi danh"></i>
                            </button>
                        @endif
                 </div>
           </div>
            
            <div class="card-content">
                <div class="mb-1">
                    {!! $course->notice !!}
                </div>
            </div>

            <a href="" class="text-main fw-bold" data-bs-toggle="modal" data-bs-target="#ModalCreateTopic"><i class="bi bi-plus-circle"></i> Thêm chủ đề mới</a>

            @foreach ($topics as $key => $topic)
                <div class="topic {{ $topic->is_show == 0 ? 'topic-hide' : '' }}">
                    <h5 class="topic-title">
                        <div class="d-flex justify-content-between">
                            <span>{!! $topic->title !!}</span>
                            <span class="pe-2 topic-control">
                                @if ($topic->is_show == 1)
                                    <i class="bi bi-eye me-1 hide-topic" title="Hiển thị" data-url="{{ route('course.hide.teacher', $topic->id) }}"></i>
                                @else
                                    <i class="bi bi-eye-slash me-1 show-topic" title="Ẩn" data-url="{{ route('course.show.teacher', $topic->id) }}"></i>
                                @endif
                                <i class="bi bi-pen me-1 edit-topic" 
                                    data-url-edit="{{ route('topic.edit', $topic->id) }}" 
                                    data-url-update="{{ route('topic.update', $topic->id) }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#ModalEditTopic" 
                                    title="Chỉnh sửa"
                                ></i>
                                <i class="bi bi-x-lg me-1 delete-topic" 
                                    data-url="{{ route('topic.delete', $topic->id) }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#ModalDeleteTopic" 
                                    title="Xóa"
                                ></i>
                                @if ($topic->pin == 1)
                                    <i class="bi bi-pin-angle-fill unpin-topic" title="Ghim" data-url="{{ route('course.unpin.teacher', $topic->id) }}"></i>
                                @else
                                    <i class="bi bi-pin-angle pin-topic" data-url="{{ route('course.pin.teacher', $topic->id) }}"></i>
                                @endif
                                
                            </span>
                        </div>
                        
                    </h5>
                    <div class="topic-content">
                        {!! $topic->content !!}   
                    </div>
                    <div class="topic-link">
                        @foreach ($documents[$key] as $document)
                        <div class="topic-document {{ $document->is_show == 0 ? 'hide' : '' }}">
                                @switch($document->type)
                                    @case(1)
                                        <a href="{{ asset('frontend/upload/'.$course->code.'/'.'document/'.$document->link) }}" target="_blank" class="{{ $document->is_show == 0 ? 'hide' : '' }}">
                                            <i class="bi bi-file-earmark"></i> {{ $document->name ?? $document->link }}
                                        </a>
                                        @break
                                    @case(2)
                                        <i class="bi bi-image-fill"></i>
                                    @break
                                    @case(3)
                                    <a href="{{ $document->link }}" target="_blank" class="{{ $document->is_show == 0 ? 'hide' : '' }}">
                                        <i class="bi bi-link-45deg"></i> {{ $document->name ?? $document->link }}
                                    </a>   
                                    @break
                                    @default
                                        <a href="{{ asset('frontend/upload/'.$course->code.'/'.'document/'.$document->link) }}" target="_blank" class="{{ $document->is_show == 0 ? 'hide' : '' }}">
                                            <i class="bi bi-file-earmark"></i> {{ $document->name ?? $document->link }}
                                        </a>
                                @endswitch

                            <span class="d-flex align-items-center">
                                <span class="ps-1 document-setting" data-doc="{{ $document->id }}"><i class="bi bi-gear" title="Tùy chỉnh"></i></span>
                                <div class="group-control-document-{{ $document->id }} ps-1" style="display: none">
                                    @if ($document->is_show == 1)
                                        <span class="ps-1 document-control hide-topic-document" data-url="{{ route('topic_document.hide', $document->id) }}">
                                            <i class="bi bi-eye" title="Đang hiển thị"></i>
                                        </span>
                                    @else
                                        <span class="ps-1 document-control show-topic-document" data-url="{{ route('topic_document.show', $document->id) }}">
                                            <i class="bi bi-eye-slash" title="Đang ẩn"></i>
                                        </span>
                                    @endif  
                                    <span class="ps-1 document-control rename-topic-document" data-url="{{ route('topic_document.rename.get', $document->id) }}" data-bs-toggle="modal" data-bs-target="#ModalRenameTopicDocument">
                                        <i class="bi bi-pen" title="Đổi tên"></i>
                                    </span>
                                    <span class="ps-1 document-control delete-topic-document" data-url="{{ route('topic_document.delete', $document->id) }}">
                                        <i class="bi bi-x-lg" title="Xóa"></i>
                                    </span>
                                </div>
                            </span>
                        </div>
                        @endforeach

                        @foreach ($exercises[$key] as $exercise)
                            <div class="exercise {{ $exercise->is_show == 0 ? 'hide' : '' }}">
                                <a href="{{ route('teacher.exercise.index', ['course_id' => $course->id, 'id' => $exercise->id]) }}" class="{{ $exercise->is_show == 0 ? 'hide' : '' }}">
                                    <i class="bi bi-journal"></i> {{ $exercise->name }}
                                </a>
                                <span class="d-flex align-items-center">
                                    <span class="ps-1 exercise-setting" data-exercise="{{ $exercise->id }}"><i class="bi bi-gear" title="Tùy chỉnh"></i></span>
                                    <div class="group-control-exercise-{{ $exercise->id }} ps-1" style="display: none">
                                        @if ($exercise->is_show == 1)
                                            <span class="ps-1 exercise-control hide-exercise" data-url="{{ route('teacher.exercise.hide', $exercise->id) }}">
                                                <i class="bi bi-eye" title="Đang hiển thị"></i>
                                            </span>
                                        @else
                                            <span class="ps-1 exercise-control show-exercise" data-url="{{ route('teacher.exercise.show', $exercise->id) }}">
                                                <i class="bi bi-eye-slash" title="Đang ẩn"></i>
                                            </span>
                                        @endif  
                                        <span class="ps-1 exercise-control edit-exercise" data-url="{{ route('teacher.exercise.edit', $exercise->id) }}" data-bs-toggle="modal" data-bs-target="#ModalEditExercise">
                                            <i class="bi bi-pen" title="Chỉnh sửa"></i>
                                        </span>
                                        <span class="ps-1 exercise-control delete-exercise" data-url="{{ route('teacher.exercise.delete', [$course->id, $exercise->id]) }}" data-bs-toggle="modal" data-bs-target="#ModalDeleteExercise">
                                            <i class="bi bi-x-lg" title="Xóa"></i>
                                        </span>
                                    </div>
                                </span>
                            </div>            
                        @endforeach

                        @foreach ($quizzes[$key] as $quiz)
                            <div class="quiz {{ $quiz->is_show == 0 ? 'hide' : '' }}">
                                <a href="{{ route('teacher.quiz.index', ['course_id' => $course->id, 'id' => $quiz->id]) }}" class="{{ $quiz->is_show == 0 ? 'hide' : '' }}">
                                    <i class="bi bi-question-circle"></i> {{ $quiz->name }}
                                </a>
                                <span class="d-flex align-items-center">
                                    <span class="ps-1 quiz-setting" data-quiz="{{ $quiz->id }}"><i class="bi bi-gear" title="Tùy chỉnh"></i></span>
                                    <div class="group-control-quiz-{{ $quiz->id }} ps-1" style="display: none">
                                        @if ($quiz->is_show == 1)
                                            <span class="ps-1 quiz-control hide-quiz" data-url="{{ route('teacher.quiz.hide', $quiz->id) }}">
                                                <i class="bi bi-eye" title="Đang hiển thị"></i>
                                            </span>
                                        @else
                                            <span class="ps-1 quiz-control show-quiz" data-url="{{ route('teacher.quiz.show', $quiz->id) }}">
                                                <i class="bi bi-eye-slash" title="Đang ẩn"></i>
                                            </span>
                                        @endif  
                                        <span class="ps-1 quiz-control edit-quiz" data-url="{{ route('teacher.quiz.edit', $quiz->id) }}" data-bs-toggle="modal" data-bs-target="#ModalEditQuiz">
                                            <i class="bi bi-pen" title="Chỉnh sửa"></i>
                                        </span>
                                        <span class="ps-1 quiz-control delete-quiz" data-url="{{ route('teacher.quiz.delete', $quiz->id) }}" data-bs-toggle="modal" data-bs-target="#ModalDeleteQuiz">
                                            <i class="bi bi-x-lg" title="Xóa"></i>
                                        </span>
                                    </div>
                                </span>
                            </div>            
                        @endforeach

                        <div class="d-flex">
                            <span class="text-main" style="cursor: pointer" onclick="uploadFile('.document', {{ $topic->id }})">
                                <i class="bi bi-folder-plus"></i> Thêm tài liệu
                            </span>
                            <form class="frm-create-document" method="post" action="{{ route('topic.document.upload', $topic->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" class="form-control input-file {{ 'document-'.$topic->id }}" name="document[]" multiple>
                            </form>
                            <span> &nbsp;-&nbsp; </span>
                            <span class="text-main add-link-topic-document" 
                                style="cursor: pointer" 
                                data-url="{{ route('topic.link.store', $topic->id) }}"
                                data-bs-toggle="modal"
                                data-bs-target="#ModalCreateLinkTopicDocument"
                                >
                                Thêm liên kết
                            </span>
                        </div> 
                        <div class="d-flex">
                            <span class="text-main add-exercise" 
                                style="cursor: pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#ModalCreateExercise"
                                data-url="{{ route('teacher.exercise.store', $topic->id) }}"
                                >
                                <i class="bi bi-file-earmark-plus"></i> Thêm bài tập
                            </span>
                            <span> &nbsp;-&nbsp; </span>
                            <span class="text-main add-quiz" 
                                style="cursor: pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#ModalCreateQuiz"
                                data-url="{{ route('teacher.quiz.store', $topic->id) }}"
                                >
                                Thi trắc nghiệm
                            </span>
                        </div> 
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
    @include('front.teacher.modal.edit_course_notice')
    @include('front.teacher.modal.create_topic')
    @include('front.teacher.modal.edit_topic')
    @include('front.teacher.modal.delete_topic')
    @include('front.teacher.modal.rename_topic_document')
    @include('front.teacher.modal.create_link_topic_document')
    @include('front.teacher.modal.create_exercise')
    @include('front.teacher.modal.delete_exercise')
    @include('front.teacher.modal.edit_exercise')
    @include('front.teacher.modal.create_quiz')
    @include('front.teacher.modal.delete_quiz')
    @include('front.teacher.modal.edit_quiz')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('content_topic_create');
        CKEDITOR.replace('content_topic_edit');
        CKEDITOR.replace('content_course_notice_edit');
        CKEDITOR.replace('content_exercise_create');
        CKEDITOR.replace('content_exercise_edit');
        var url_back = "{{ route('course.view.teacher', $course->id) }}";
    </script>
    <script src="{{ asset('frontend/assets/js/course/teacher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/course/topic.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/course/topic_document.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/exercise/teacher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/quiz/teacher.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.js') }}" ></script>
    <script>
        $('#expiration_date_exercise_create, #expiration_date_exercise_edit').datetimepicker({
            format: 'd-m-Y H:i',
            step: 30
        });
        $('#start_time_quiz_create, #end_time_quiz_create').datetimepicker({
            format: 'd-m-Y H:i',
            step: 30
        });
    </script>
    <script>
        $('.document-setting').click(function(){
            var id = $(this).attr('data-doc');
            $(this).hide();
            $('.group-control-document-'+id).toggle();
        });
        $('.exercise-setting').click(function(){
            var id = $(this).attr('data-exercise');
            $(this).hide();
            $('.group-control-exercise-'+id).toggle();
        });
        $('.quiz-setting').click(function(){
            var id = $(this).attr('data-quiz');
            $(this).hide();
            $('.group-control-quiz-'+id).toggle();
        });
    </script>
@endsection