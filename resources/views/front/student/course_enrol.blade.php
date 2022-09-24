@extends('template.master_layout')

@section('title', 'Ghi danh lớp học')

@section('breadcrumb')
     <li class="breadcrumb-item active">Thông tin lớp học</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-title">Thông tin lớp học</div>
                    </div>
                    
                    <div class="information ms-3">
                        <div>{!! $course->introduce !!}</div>
                        <div><strong class="text-main">Mã lớp: </strong>{{ $course->code }}</div>
                        <div><strong class="text-main">Tên lớp: </strong>{{ $course->name }}</div>
                        <div><strong class="text-main">Giáo viên: </strong>{{ $course->teacher_name }}</div>
                    </div>
                    @if (auth()->guard('student')->check())
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('course.enrol', $course->id) }}" class="btn-slide01">Ghi danh tôi</a>
                        </div>
                    @else
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('home') }}" class="btn-slide01">Về trang chủ</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection