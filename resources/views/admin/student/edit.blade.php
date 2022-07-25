@extends('template.admin')

@section('title', 'Chỉnh sửa thông tin học sinh')

@section('pagetitle', 'Chỉnh sửa thông tin học sinh')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Tài khoản học sinh</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chỉnh sửa tài khoản</h5>

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
                    
                    <form action="{{ route('student.update', ['student' => $info->id]) }}" method="post" class="row g-3">
                      @csrf
                      @method('patch')
                        <div class="col-12 col-md-6">
                          <label for="username" class="form-label">Mã số (*)</label>
                          <input type="text" class="form-control" name="username" id="username" value="{{ (old('username')) ? old('username') : $info->username }}">
                          @error('username')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12 col-md-6">
                          <label for="name" class="form-label">Họ và tên (*)</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ (old('name')) ? old('name') : $info->name }}">
                          @error('name')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="date_of_birth" class="form-label">Ngày sinh (*)</label>
                            <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ (old('date_of_birth')) ? old('date_of_birth') : date('d-m-Y', strtotime($info->date_of_birth)) }}">
                            @error('date_of_birth')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                          </div>
                        <div class="col-12 col-md-6">
                            <fieldset class="row mb-1">
                                <legend class="col-form-label col-sm-4 pt-0">Giới tính (*)</legend>
                                <div class="col-sm-8">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender0" value="0" 
                                    
                                    @if (old('gender') !== NULL)
                                      {{ (old('gender') == 0) ? 'checked' : '' }}
                                    @else
                                      {{  ($info->gender == 0) ? 'checked' : '' }}
                                    @endif

                                    >
                                    <label class="form-check-label" for="gender0">
                                      Nam
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" 
                                      
                                    @if (old('gender') !== NULL)
                                        {{ (old('gender') == 1) ? 'checked' : '' }}
                                      @else
                                        {{ ($info->gender == 1) ? 'checked' : '' }}
                                      @endif

                                    >
                                    <label class="form-check-label" for="gender1">
                                      Nữ
                                    </label>
                                  </div>
                                </div>
                                @error('gender')
                                  <div class="text-danger ps-3 pt-1">{!! $message !!}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-12 col-md-6">
                          <label for="place_of_birth" class="form-label">Nơi sinh (*)</label>
                          <input type="text" class="form-control" name="place_of_birth" id="place_of_birth" value="{{ (old('place_of_birth')) ? old('place_of_birth') :  $info->place_of_birth }}">
                          @error('place_of_birth')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="class" class="form-label">Lớp (*)</label>
                            <select name="class" id="class" class="form-select">
                              <option value="">Chưa chọn lớp</option>
                              
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" 

                                      @if (old('class') !== NULL)
                                        {{ (old('class') == $class->id) ? 'selected' : '' }}
                                      @else
                                        {{ ($info->class_id == $class->id) ? 'selected' : '' }}
                                      @endif
                                    >
                                      
                                      {{ $class->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('class')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                          <label for="address" class="form-label">Địa chỉ</label>
                          <input type="text" class="form-control" name="address" id="address" value="{{ (old('address')) ? old('address') :  $info->address }}">
                          @error('address')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>
                        <div class="col-12 col-md-6">
                          <label for="phone" class="form-label">Điện thoại</label>
                          <input type="text" class="form-control" name="phone" id="phone" value="{{ (old('phone')) ? old('phone') :  $info->phone }}">
                          @error('phone')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ (old('email')) ? old('email') :  $info->email }}">
                            @error('email')
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