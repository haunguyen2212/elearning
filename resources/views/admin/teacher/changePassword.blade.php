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

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Đổi mật khẩu</h5>
                        </div>
                        
                        @if ($teacher->active == '0')
                            <div class="bd-highlight">
                                <form action="{{ route('teacher.lock', ['id' => $teacher->id]) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button
                                    type="submit" 
                                    class="btn btn-sm btn-main" 
                                    data-bs-toggle="tooltip" 
                                    title="Mở khóa tài khoản"
                                    >
                                    <i class="bi bi-unlock"></i>
                                    </button>
                                </form>    
                            </div>
                        @else
                            <div class="bd-highlight">
                                <form action="{{ route('teacher.lock', ['id' => $teacher->id]) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button 
                                    class="btn btn-sm btn-main" 
                                    data-bs-toggle="tooltip" 
                                    title="Khóa tài khoản"
                                    >
                                        <i class="bi bi-lock"></i>
                                    </button>
                                </form>
                            </div>
                        @endif

                      </div>

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

                    <form action="{{ route('teacher.pass.update', ['id' => $teacher->id ]) }}" method="post" class="row g-3">
                        @csrf
                        @method('patch')
                        <div class="col-12">
                            <label for="password" class="form-label">Mật khẩu mới cho {{ $teacher->name }} (*)</label>
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
        $('#user-link').removeClass('collapsed');
        $('#teacher').addClass('active');
    </script>
@endsection