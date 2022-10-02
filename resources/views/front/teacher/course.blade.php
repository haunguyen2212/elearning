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

            @foreach ($topics as $key => $topic)
                <div class="topic">
                    <h5 class="topic-title">
                        <div class="d-flex justify-content-between">
                            <span>{{ $topic->title }}</span>
                            <span class="pe-2">
                                @if ($topic->is_show == 1)
                                    <i class="bi bi-eye me-1" title="Hiển thị"></i>
                                @else
                                    <i class="bi bi-eye-slash me-1" title="Ẩn"></i>
                                @endif
                                <i class="bi bi-pen me-1" title="Chỉnh sửa"></i>
                                <i class="bi bi-x-lg me-1" title="Xóa"></i>
                                @if ($topic->pin == 1)
                                    <i class="bi bi-pin-angle-fill" title="Ghim"></i>
                                @else
                                    <i class="bi bi-pin-angle"></i>
                                @endif
                                
                            </span>
                        </div>
                        
                    </h5>
                    <div class="topic-content">
                        {{ $topic->content }}     
                    </div>
                    <div class="topic-link">
                        @foreach ($documents[$key] as $document)
                            <a href="{{ $document->link }}">
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
@endsection