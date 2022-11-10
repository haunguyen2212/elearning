@extends('template.master_layout')

@section('title', 'Câu hỏi trắc nghiệm')

@section('breadcrumb')
    <li class="breadcrumb-item active">Câu hỏi trắc nghiệm</li>
@endsection

@section('content')
    <div class="card main-card">
        <div class="card-body px-4">
            <div class="card-title mb-0">Câu hỏi trắc nghiệm</div>
            <div class="card-content">
                <div class="text-main">Chọn môn học bên dưới:</div>
                @foreach ($subjects as $subject)
                    <div class="mt-1">
                        <a href="{{ route('teacher.question.view', $subject->id) }}">- Câu hỏi trắc nghiệm môn {{ $subject->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection