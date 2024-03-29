@extends('template.master_layout')

@section('title', 'Bài tập')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.teacher',$course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">Bài tập</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/exercise_score.css') }}">
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
            <div class="card-title mb-0">{!! $exercise->name !!}</div>
            <div class="card-content exercise-main">
                <div>
                    <p class="mb-0 exercise-content">
                        {!! $exercise->content !!}
                    </p>
                    <div class="mb-2">
                        @foreach ($exerciseDocuments as $exerciseDocument)
                            <div class="exercise {{ $exerciseDocument->is_show == 0 ? 'hide' : '' }}">
                                <a href="{{ asset('frontend/upload/'.$course->code.'/'.'exercise/'.$exerciseDocument->link) }}" class="{{ $exerciseDocument->is_show == 0 ? 'hide' : '' }}" target="_blank"><i class="bi bi-file-earmark"></i> {{ $exerciseDocument->link ?? $exerciseDocument->link }}</a>
                                <span>
                                    <i class="bi bi-x text-danger btn-delete-exercise-document" 
                                        title="Xoá" 
                                        style="cursor: pointer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ModalDeleteExerciseDocument"
                                        data-url="{{ route('teacher.exercise_document.delete', [$course->id, $exerciseDocument->id] ) }}"
                                    ></i>
                                </span>
                            </div>
                        @endforeach
                        <span class="text-main fw-bold" style="cursor: pointer" onclick="uploadExercise('.exercise-document-link')">
                            <i class="bi bi-upload"></i> Thêm tài liệu
                        </span>
                        <form class="frm-submit-exercise-document" method="post" action="{{ route('teacher.exercise.upload', ['course_id' => $course->id, 'id' => $exercise->id ]) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="form-control input-file exercise-document-link" name="link[]" multiple>
                        </form>
                    </div>
                    <div>
                        <ul class="ps-0 mb-2">
                            <li><strong class="text-main">Ngày giao:</strong><span> {{ date('d/m/Y H:i:s', strtotime($exercise->assignment_date)) }}</span></li>
                            <li><strong class="text-main">Hạn cuối nộp bài:</strong><span> {{ date('d/m/Y H:i:s', strtotime($exercise->expiration_date)) }}</span></li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <table class="table table-borderless table-bordered">
                            <thead>
                                <th>Mã học sinh</th>
                                <th>Họ tên học sinh</th>
                                <th>Bài đã nộp</th>
                                <th>Thời gian nộp</th>
                                <th>Điểm</th>
                            </thead>
                            <tbody>
                                @foreach ($listStudent as $student)
                                    <tr>
                                        <td>{{ $student->username }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            @foreach ($submitExercises[$student->id] as $submitExercise)
                                                <div><a href="{{ asset('frontend/upload/'.$course->code.'/'.$student->username.'/'.$submitExercise->link) }}">{{ $submitExercise->link }}</a></div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($submitExercises[$student->id] as $submitExercise)
                                                <div>{{ date('d/m/Y H:i:s', strtotime($submitExercise->created_at)) }}</div>
                                            @endforeach
                                        </td>
                                        <td class="score-style">
                                            <span class="show">
                                                <input type="number" 
                                                    class="edit-score" 
                                                    data-url="{{ route('teacher.exercise.score.update', ['id' => $exercise->id, 'student_id' => $student->id]) }}"
                                                    value="{{ $scores[$student->id]['score'] ?? '' }}" 
                                                    min="0" 
                                                    max="10" 
                                                    readonly
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <button class="btn-slide03 mx-1 delete-exercise" data-url="{{ route('teacher.exercise.delete', [$course->id, $exercise->id]) }}" data-bs-toggle="modal" data-bs-target="#ModalDeleteExercise">Xoá bài tập</button>
                        <button class="btn-slide05 mx-1 edit-exercise" data-url="{{ route('teacher.exercise.edit', $exercise->id) }}" data-bs-toggle="modal" data-bs-target="#ModalEditExercise">Sửa bài tập</button>
                        <a href="{{ route('course.view.teacher', $course->id) }}" class="btn-slide01 mx-1">Về khóa học</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.teacher.modal.delete_exercise_document')
    @include('front.teacher.modal.delete_exercise')
    @include('front.teacher.modal.edit_exercise')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.js') }}" ></script>
    <script>
        var url_back = window.location.href;
        var url_previous = '{{ route('course.view.teacher', $course->id) }}';
        CKEDITOR.replace('content_exercise_edit');
    </script>
    <script>
        $('#expiration_date_exercise_edit').datetimepicker({
            format: 'd-m-Y H:i',
            step: 30
        });
    </script>
    <script src="{{ asset('frontend/assets/js/course/teacher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/exercise/teacher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/exercise/exercise_document.js') }}"></script>
@endsection
