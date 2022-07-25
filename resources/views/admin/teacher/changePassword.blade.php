@extends('template.admin')

@section('title', 'Đổi mật khẩu')

@section('pagetitle', 'Thay đổi mật khẩu')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.index') }}">Tài khoản giáo viên</a></li>
    <li class="breadcrumb-item active">Đổi mật khẩu</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Đổi mật khẩu</h5>

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

                    <form action="{{ route('teacher.pass.update', ['id' => request()->id ]) }}" method="post" class="row g-3">
                        @csrf
                        @method('patch')
                        <div class="col-12">
                            <label for="password" class="form-label">Mật khẩu mới cho {{ $teacherName }} (*)</label>
                            <input type="password" class="form-control" name="password" id="password">
                            @error('password')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>  
                        <div class="text-center">
                          <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
                          <a href="{{ route('teacher.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#user-nav').addClass('show');
        $('#teacher').addClass('active');
    </script>
@endsection