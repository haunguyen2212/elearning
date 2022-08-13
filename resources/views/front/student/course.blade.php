@extends('template.master_layout')

@section('title', 'Khoá học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Khóa học của tôi</li>
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
                        {{ $topic->title }}
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