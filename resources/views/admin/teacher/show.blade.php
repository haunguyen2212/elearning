@extends('template.admin')

@section('title', 'Thông tin giáo viên')

@section('pagetitle', 'Thông tin giáo viên')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.index') }}">Tài khoản giáo viên</a></li>
    <li class="breadcrumb-item active">Xem thông tin</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Xem thông tin</h5>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Tài khoản:</strong> {{ $info->username }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Họ và tên:</strong> {{ $info->name }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Giới tính:</strong> {{ ($info->gender)?'Nữ':'Nam' }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Đơn vị:</strong> {{ $info->department_name}}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Ngày sinh:</strong> {{ date('d/m/Y',strtotime($info->date_of_birth)) }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Số điện thoại:</strong> {{ $info->phone }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Email:</strong> {{ $info->email }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Địa chỉ:</strong> {{ $info->address }}
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <strong class="text-main">Trạng thái:</strong> 
                            @if ($info->active)
                                <strong class="text-success">Hoạt động</strong> 
                            @else
                                <strong class="text-danger">Bị khóa</strong>  
                            @endif
                        </div>
                        <div class="text-center mt-2">
                            <a href="{{ route('teacher.edit',['teacher'=>$info->id]) }}" class="btn btn-sm btn-success">Chỉnh sửa</a>
                            <a href="{{ route('teacher.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                          </div>
                    </div>
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