@extends('template.master_layout')

@section('title', 'Khoá học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Khóa học</li>
    <li class="breadcrumb-item active">{{ $course->name }}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            <div class="card-title"><i class="bi bi-info-circle-fill"></i> Các thông báo</div>
            <div class="card-content">
                <div>
                    {!! $course->notice !!}
                </div>
            </div>

            <a href="" class="text-main fw-bold" data-bs-toggle="modal" data-bs-target="#ModalCreateTopic"><i class="bi bi-plus-circle"></i> Thêm chủ đề mới</a>

            @foreach ($topics as $key => $topic)
                <div class="topic">
                    <h5 class="topic-title">
                        <div class="d-flex justify-content-between">
                            <span>{!! $topic->title !!}</span>
                            <span class="pe-2">
                                @if ($topic->is_show == 1)
                                    <i class="bi bi-eye me-1 hide-topic" title="Hiển thị" data-url="{{ route('course.hide.teacher', $topic->id) }}"></i>
                                @else
                                    <i class="bi bi-eye-slash me-1 show-topic" title="Ẩn" data-url="{{ route('course.show.teacher', $topic->id) }}"></i>
                                @endif
                                <i class="bi bi-pen me-1" title="Chỉnh sửa"></i>
                                <i class="bi bi-x-lg me-1" title="Xóa"></i>
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
                            <a href="{{ asset('frontend/upload/TN1001/document/'.$document->link) }}" target="_blank">
                                @switch($document->type)
                                    @case(1)
                                        <i class="bi bi-file-earmark"></i>
                                        @break
                                    @case(2)
                                        <i class="bi bi-image-fill"></i>
                                    @break
                                    @case(3)
                                        <i class="bi bi-link-45deg"></i>
                                    @break
                                    @default
                                        <i class="bi bi-file-earmark"></i>
                                @endswitch
                                {{ $document->name ?? $document->link }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
    @include('front.teacher.modal.create_topic')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('content_topic_create');
    </script>
    <script src="{{ asset('frontend/assets/js/course/teacher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/course/topic.js') }}"></script>
@endsection