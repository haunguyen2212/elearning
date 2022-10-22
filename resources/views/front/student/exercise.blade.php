@extends('template.master_layout')

@section('title', 'Bài tập')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.student', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">Bài tập</li>
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
            <div class="card-content">
                <div>
                    <p class="mb-0">
                        {!! $exercise->content !!}
                    </p>
                    <div class="mb-2">
                        @foreach ($exerciseDocuments as $exerciseDocument)
                            <div>
                                <a href="{{ asset('frontend/upload/'.$course->code.'/'.'exercise/'.$exerciseDocument->link) }}" target="_blank"><i class="bi bi-file-earmark"></i> {{ $exerciseDocument->link ?? $exerciseDocument->link }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <ul class="ps-0 mb-2">
                            <li><strong class="text-main">Ngày giao:</strong><span> {{ date('d/m/Y H:i:s', strtotime($exercise->assignment_date)) }}</span></li>
                            <li><strong class="text-main">Hạn cuối nộp bài:</strong><span> {{ date('d/m/Y H:i:s', strtotime($exercise->expiration_date)) }}</span></li>
                        </ul>
                    </div>
                    <div>
                        @if ($exercise->expiration_date > \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                            <span class="text-main fw-bold" style="cursor: pointer" onclick="uploadExercise('.exercise-link')">
                                <i class="bi bi-upload"></i> Nộp bài tập
                            </span>
                            <form class="frm-submit-exercise" method="post" action="{{ route('student.exercise.upload', ['course_id' => $course->id, 'id' => $exercise->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" class="form-control input-file exercise-link" name="link[]" multiple>
                            </form>
                        @elseif (count($submitFiles) > 0)
                            <span class="text-main fw-bold">Bài tập đã nộp:</span>
                        @endif
                        
                        @foreach ($submitFiles as $submitFile)
                            <div>
                                <a href="{{ asset('frontend/upload/'.$course->code.'/'.auth()->guard('student')->user()->username.'/'.$submitFile->link) }}" target="_blank"><i class="bi bi-file-earmark"></i> {{ $submitFile->link }}</a>
                                @if ($exercise->expiration_date > \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                                <span>
                                    <i class="bi bi-x text-danger btn-delete-exercise" 
                                        title="Xoá" 
                                        style="cursor: pointer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ModalDeleteExercise"
                                        data-url="{{ route('student.exercise.delete', [$course->id, $submitFile->id]) }}"
                                    ></i>
                                </span>
                                @endif
                            </div>
                        @endforeach
                        @if ($exercise->expiration_date < \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                            <span class="text-danger fw-bold">
                                Đã hết hạn nộp bài tập
                            </span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('course.view.student', $course->id) }}" class="btn-slide01">Về khóa học</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.student.modal.delete_exercise')
@endsection

@section('script')
    <script src="{{ asset('frontend/assets/js/exercise/student.js') }}"></script>
@endsection