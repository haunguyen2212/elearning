@extends('template.admin')

@section('title', 'Thông tin khóa học')

@section('pagetitle', 'Thông tin khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Khóa học</a></li>
    <li class="breadcrumb-item active">Xem thông tin</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Xem thông tin</h5>
                    <div class="row">
                        <div class="col-12 col-md-12 mb-1">
                            <strong class="text-main">Mã khóa học:</strong> {{ $course->code }}
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <strong class="text-main">Tên khóa học:</strong> {{ $course->name }}
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <strong class="text-main">Môn học:</strong> {{ $course->subject_name }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Giáo viên:</strong> {{ $course->teacher_name }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Học sinh:</strong> {{ $num_enrol }}
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <strong class="text-main">Giới thiệu:</strong> {!! $course->introduce !!}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Ghi danh:</strong> {{ $course->is_enrol == 1 ? 'Cho phép' : 'Không' }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Hiển thị:</strong> {{ $course->is_show == 1 ? 'Có' : 'Không' }}
                        </div>
                        
                        <div class="text-center mt-2">
                            <a href="{{ route('course.edit', ['course' => $course->id]) }}" class="btn btn-sm btn-success">Chỉnh sửa</a>
                            <a href="{{ route('course.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#course-nav').addClass('show');
            $('#course-link').removeClass('collapsed');
            $('#list-course').addClass('active');
        });
        CKEDITOR.replace('introduce');
    </script>
@endsection