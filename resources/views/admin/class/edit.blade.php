@extends('template.admin')

@section('title', 'Chỉnh sửa lớp học')

@section('pagetitle', 'Chỉnh sửa lớp học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('class.index') }}">Lớp học</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chỉnh sửa lớp học</h5>

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
                    
                    <form action="{{ route('class.update', ['class' => request()->class]) }}" method="post" class="row g-3">
                      @csrf
                      @method('patch')
                        <div class="col-12">
                          <label for="name" class="form-label">Tên lớp (*)</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ (old('name')) ? old('name') : $info['name'] }}">
                          @error('name')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12">
                            <label for="homeroom_teacher" class="form-label">Chủ nhiệm (*)</label>
                            <select name="homeroom_teacher" id="homeroom_teacher" class="form-select">
                              <option value="">Chưa chọn giáo viên</option>
                              
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" 

                                      @if (old('homeroom_teacher') !== NULL)
                                        {{ (old('homeroom_teacher') == $teacher->id) ? 'selected' : '' }}
                                      @else
                                        {{ ($info['teacher_id'] == $teacher->id) ? 'selected' : '' }}
                                      @endif
                                    >
                                      
                                      {{ $teacher->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('homeroom_teacher')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        <div class="text-center mt-3">
                          <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
                          <a href="{{ route('class.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#departments-nav').addClass('show');
        $('#classrooms').addClass('active');
    </script>
@endsection