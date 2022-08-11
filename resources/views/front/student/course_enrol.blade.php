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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-title">Thông tin lớp học</div>
                    </div>
                    
                    <div class="information ms-3">
                        <div>{!! $course->introduce !!}</div>
                        <div><strong class="text-main">Mã lớp: </strong>{{ $course->code }}</div>
                        <div><strong class="text-main">Tên lớp: </strong>{{ $course->name }}</div>
                        <div><strong class="text-main">Giáo viên: </strong>{{ $course->teacher_name }}</div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="" class="btn-slide01">Ghi danh tôi</a>
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}"><i class="bi bi-box-arrow-up-left"></i> Trang trước</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection