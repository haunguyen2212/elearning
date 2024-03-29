@extends('template.admin')

@section('title', 'Thay chủ nhiệm')

@section('pagetitle', 'Thay giáo viên chủ nhiệm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('class.index') }}">Lớp học</a></li>
    <li class="breadcrumb-item active">Thay chủ nhiệm</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thay chủ nhiệm lớp {{ $className }}</h5>

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

                    <form action="{{ route('class.homeroomTeacher.update', ['id' => request()->id]) }}" method="post" class="row g-3">
                      @csrf
                      @method('patch')

                        <div class="col-12">
                            <label for="homeroom_teacher" class="form-label">Chủ nhiệm mới (*)</label>
                            <select name="homeroom_teacher" id="homeroom_teacher" class="form-select">
                              <option value="" selected>Chưa chọn chủ nhiệm</option>
                              
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ (old('homeroom_teacher') == $teacher->id) ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                @endforeach

                            </select>
                            @error('homeroom_teacher')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center mt-4">
                          <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
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
        $('#department-link').removeClass('collapsed');
        $('#classrooms').addClass('active');
    </script>
@endsection