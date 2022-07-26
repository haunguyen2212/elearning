@extends('template.login')

@section('content')
<div class="pt-2 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">ĐĂNG NHẬP</h5>
    <p class="text-center text-main">Tài khoản học sinh - giáo viên</p>
  </div>

  @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  @endif

  <form action="{{ route('login.check') }}" method="post" class="row g-3">
    @csrf
    <div class="col-12">
      <label for="username" class="form-label">Tài khoản (*)</label>
      <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
      @error('username')
        <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
      @enderror
    </div>

    <div class="col-12">
      <label for="password" class="form-label">Mật khẩu (*)</label>
      <input type="password" name="password" class="form-control" id="password">
      @error('password')
        <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
      @enderror
    </div>

    <div class="col-12 mb-3 mt-5">
      <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
    </div>
  </form>
@endsection