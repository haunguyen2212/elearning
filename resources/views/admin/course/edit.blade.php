@extends('template.admin')

@section('title', 'Chỉnh sửa khóa học')

@section('pagetitle', 'Chỉnh sửa khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Khóa học</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chỉnh sửa khóa học</h5>

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

                    <form action="{{ route('course.update', ['course' => $course->id]) }}" method="post" class="row g-3">
                      @csrf
                      @method('put')

                        <div class="col-12 col-md-6">
                            <label for="code" class="form-label">Mã khóa học (*)</label>
                            <input type="text" class="form-control" name="code" id="code" value="{{ old('code') ?? $course->code }}">
                            @error('code')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                          <label for="name" class="form-label">Tên khóa học (*)</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $course->name }}">
                          @error('name')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="teacher_id" class="form-label">Giáo viên (*)</label>
                            <select name="teacher_id" id="teacher_id" class="form-select">
                              <option value="">Chưa chọn giáo viên</option>
                              @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') ? (old('teacher_id') == $teacher->id ? 'selected' : '') : ($course->teacher_id == $teacher->id ? 'selected' : '') }}>{{ $teacher->name }}</option>
                              @endforeach
                            </select>
                            @error('teacher_id')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="is_enrol" class="form-label">Cho phép ghi danh (*)</label>
                            <select name="is_enrol" id="is_enrol" class="form-select">
                                <option value="1" {{ old('is_enrol') ? (old('is_enrol') == 1 ? 'selected' : '') : ($course->is_enrol == 1 ? 'selected' : '') }}>Cho phép</option>
                                <option value="0" {{ old('is_enrol') ? (old('is_enrol') == 0 ? 'selected' : '') : ($course->is_enrol == 0 ? 'selected' : '') }}>Không cho phép</option>
                              </select>
                            @error('is_enrol')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="introduce" class="form-label">Giới thiệu</label>
                            <textarea class="form-control" name="introduce" id="introduce" rows="4">{{ old('introduce') ?? $course->introduce }}</textarea>
                            @error('introduce')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Hiển thị khóa học (*)</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_show" id="is_show1" value="1" {{ old('is_show') ? (old('is_show') == 1 ? 'checked' : '') : ($course->is_show == 1 ? 'checked' : '')}}>
                                <label class="form-check-label" for="is_show1">
                                  Có
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_show" id="is_show2" value="0" {{ old('is_show') ? (old('is_show') == 0 ? 'checked' : '') : ($course->is_show == 0 ? 'checked' : '')}}>
                                <label class="form-check-label" for="is_show2">
                                  Không
                                </label>
                              </div>
                            @error('is_show')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                          </div>
                        <div class="text-center mt-4">
                          <button type="submit" class="btn btn-sm btn-primary">Thay đổi</button>
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