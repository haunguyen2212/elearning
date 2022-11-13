@extends('template.master_layout')

@section('title', 'Tài khoản')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tài khoản</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            @if (session('message'))
                <div class="alert alert-message alert-dismissible fade show" role="alert">
                    <div class="text-main"><i class="bi bi-exclamation-circle"></i> {{ session('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <div class="bd-highlight">
                    <div class="card-title mb-0">Thông tin tài khoản</div>
                </div>
            </div>
            
            <div class="card-content">
                @if (auth()->guard('student')->check())
                    <div class="row">
                        <div class="col-12 mt-2 col-md-4">
                            <strong class="text-main">Tài khoản: </strong>
                            <span>{{ $profile->username }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-5">
                            <strong class="text-main">Họ và tên: </strong>
                            <span>{{ $profile->name }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-3">
                            <strong class="text-main">Phái: </strong>
                            <span>{{ $profile->gender == 0 ? 'Nam' : 'Nữ' }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-4">
                            <strong class="text-main">Ngày sinh: </strong>
                            <span>{{ date('d/m/Y', strtotime($profile->date_of_birth)) }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-5">
                            <strong class="text-main">Nơi sinh: </strong>
                            <span>{{ $profile->place_of_birth }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-3">
                            <strong class="text-main">Lớp: </strong>
                            <span>{{ $profile->class_name }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-4">
                            <strong class="text-main">Điện thoại: </strong>
                            <span>{{ $profile->phone }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-8">
                            <strong class="text-main">Email: </strong>
                            <span>{{ $profile->email }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-12">
                            <strong class="text-main">Địa chỉ: </strong>
                            <span>{{ $profile->address }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-12">
                            <strong class="text-primary text-decoration-underline" 
                                style="cursor: pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#ModalChangePassword"
                            >
                                Đổi mật khẩu
                            </strong>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalEditProfile" data-url="{{ route('student.profile.edit') }}" class="btn-slide05 btn-edit-profile mx-1">Cập nhật thông tin</button>
                   </div>
                    @include('front.student.modal.edit_profile')
                    @include('front.student.modal.change_password')
                @endif
                @if (auth()->guard('teacher')->check())
                    <div class="row">
                        <div class="col-12 mt-2 col-md-4">
                            <strong class="text-main">Tài khoản: </strong>
                            <span>{{ $profile->username }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-5">
                            <strong class="text-main">Họ và tên: </strong>
                            <span>{{ $profile->name }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-3">
                            <strong class="text-main">Phái: </strong>
                            <span>{{ $profile->gender == 0 ? 'Nam' : 'Nữ' }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-4">
                            <strong class="text-main">Ngày sinh: </strong>
                            <span>{{ date('d/m/Y', strtotime($profile->date_of_birth)) }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-8">
                            <strong class="text-main">Đơn vị: </strong>
                            <span>{{ $profile->department_name }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-4">
                            <strong class="text-main">Điện thoại: </strong>
                            <span>{{ $profile->phone }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-8">
                            <strong class="text-main">Email: </strong>
                            <span>{{ $profile->email }}</span>
                        </div>
                        <div class="col-12 mt-2 col-md-12">
                            <strong class="text-main">Địa chỉ: </strong>
                            <span>{{ $profile->address }}</span>
                        </div>
                    </div>
                    <div class="col-12 mt-2 col-md-12">
                        <strong class="text-primary text-decoration-underline" 
                            style="cursor: pointer"
                            data-bs-toggle="modal"
                            data-bs-target="#ModalChangePassword"
                        >
                            Đổi mật khẩu
                        </strong>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalEditProfile" data-url="{{ route('teacher.profile.edit') }}" class="btn-slide05 btn-edit-profile mx-1">Cập nhật thông tin</button>
                   </div>
                    @include('front.teacher.modal.update_profile')
                    @include('front.teacher.modal.change_password')
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $("#date_of_birth_edit").datepicker({
            dateFormat:"dd-mm-yy",
        });
    </script>
    @if (auth()->guard('student')->check())
        <script src="{{ asset('frontend/assets/js/profile/student.js') }}"></script>
    @endif
    @if (auth()->guard('teacher')->check())
        <script src="{{ asset('frontend/assets/js/profile/teacher.js') }}"></script>
    @endif
    
@endsection

