@extends('template.master_layout')

@section('title', 'Khoá học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Khóa học của tôi</li>
    <li class="breadcrumb-item active">{{ $course->name }}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            <div class="card-title mb-0"><i class="bi bi-info-circle-fill"></i> Các thông báo</div>
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
                            <span class="pe-2 topic-control">
                                @if ($topic->pin == 1)
                                    <i class="bi bi-pin-angle-fill" title="Đang ghim"></i>
                                @endif
                            </span>
                        </div>
                    </h5>
                    <div class="topic-content">
                        {!! $topic->content !!}     
                    </div>
                    <div class="topic-link">
                        @foreach ($documents[$key] as $document)         
                                @switch($document->type)
                                    @case(1)
                                        <a href="{{ asset('frontend/upload/'.$course->code.'/'.'document/'.$document->link) }}" target="_blank">
                                            <i class="bi bi-file-earmark"></i> {{ $document->name ?? $document->link }}
                                        </a>
                                        @break
                                    @case(2)
                                        <i class="bi bi-image-fill"></i>
                                    @break
                                    @case(3)
                                        <a href="{{ $document->link }}" target="_blank">
                                            <i class="bi bi-link-45deg"></i> {{ $document->name ?? $document->link }}
                                        </a>
                                    @break
                                    @default
                                        <a href="{{ asset('frontend/upload/'.$course->code.'/'.'document/'.$document->link) }}" target="_blank">
                                            <i class="bi bi-file-earmark"></i> {{ $document->name ?? $document->link }}
                                        </a>
                                @endswitch
                        @endforeach
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
@endsection