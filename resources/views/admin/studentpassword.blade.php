@extends('template.admin')

@section('title', 'Đổi mật khẩu')

@section('pagetitle', 'Thay đổi mật khẩu')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Tài khoản học sinh</a></li>
    <li class="breadcrumb-item active">Đổi mật khẩu</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Đổi mật khẩu</h5>
                    <form action="{{ route('student.pass.update', ['id' => request()->id ]) }}" method="post" class="row g-3">
                        @csrf
                        @method('patch')
                        <div class="col-12">
                            <label for="password" class="form-label">Mật khẩu mới cho {{ $studentName }} (*)</label>
                            <input type="password" class="form-control" name="password" id="password">
                            @error('password')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>  
                        <div class="text-center">
                          <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
                          <a href="{{ route('student.index') }}" class="btn btn-sm btn-danger">Trở về</a>
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
        $('#student').addClass('active');
    </script>
@endsection