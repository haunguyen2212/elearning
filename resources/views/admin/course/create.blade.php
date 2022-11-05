@extends('template.admin')

@section('title', 'Thêm mới khóa học')

@section('pagetitle', 'Thêm mới khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Khóa học</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thêm khóa học</h5>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('course.store') }}" method="post" class="row g-3">
                      @csrf

                        <div class="col-12 col-md-6">
                            <label for="code" class="form-label">Mã khóa học (*)</label>
                            <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}">
                            @error('code')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                          <label for="subject_id" class="form-label">Môn học (*)</label>
                          <select name="subject_id" id="subject_id" class="form-select">
                            <option value="">Chưa chọn môn học</option>
                            @foreach ($subjects as $subject)
                              <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                          </select>
                          @error('subject_id')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12 col-md-12">
                          <label for="name" class="form-label">Tên khóa học (*)</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                          @error('name')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="teacher_id" class="form-label">Giáo viên (*)</label>
                            <select name="teacher_id" id="teacher_id" class="form-select">
                              <option value="">Chưa chọn giáo viên</option>
                              @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                              @endforeach
                            </select>
                            @error('teacher_id')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="is_enrol" class="form-label">Cho phép ghi danh (*)</label>
                            <select name="is_enrol" id="is_enrol" class="form-select">
                                <option value="1" {{ old('is_enrol') == 1 ? 'selected' : '' }}>Cho phép</option>
                                <option value="0" {{ old('is_enrol') == 0 ? 'selected' : '' }}>Không cho phép</option>
                              </select>
                            @error('is_enrol')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                          </div>

                        <div class="col-12">
                            <label for="introduce" class="form-label">Giới thiệu</label>
                            <textarea class="form-control" name="introduce" id="introduce" rows="4">{{ old('introduce') }}</textarea>
                            @error('introduce')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center mt-4">
                          <button type="submit" class="btn btn-sm btn-primary">Thêm mới</button>
                          <a href="{{ route('course.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#course-nav').addClass('show');
            $('#course-link').removeClass('collapsed');
            $('#list-course').addClass('active');
        });
        CKEDITOR.replace('introduce');
    </script>
@endsection