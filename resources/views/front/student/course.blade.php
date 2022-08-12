@extends('template.master_layout')

@section('title', 'Khoá học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Khóa học của tôi</li>
    <li class="breadcrumb-item active">{{ $course->name }}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            <div class="card-title"><i class="bi bi-info-circle-fill"></i> Các thông báo</div>
            <div class="card-content">
                <div>
                    {{-- THÔNG BÁO THI THỰC HÀNH 7/5/2022 VÀ THI LÝ THUYẾT 14/5/2022 <br>
                    Thi thực hành ngày 7/5 - Thời Gian thí lúc: 7h 00 -  (chấm bài tại lớp, em nào bỏ về chấm điểm 0, được xem slide bài giảng in). Lưu ý sinh viên có mặt lúc 6h45 chuẩn bị máy để thi.<br>
                    Network Phòng 18: 172.30.113.0/24  - 172.N.M.(100+X), N,M tương tự máy thật, X là số thứ tự máy trong phòng.<br>
                    Network Phòng 25: 172.30.120.0/24 - - 172.N.M.(100+X), N,M tương tự máy thật, X là số thứ tự máy trong phòng. --}}
                </div>
            </div>
            <div class="topic">
                <h5 class="topic-title">
                    kế hoạch Giảng dạy
                </h5>
                <div class="topic-content">
                    Kế hoạch giảng dạy học phần Quản trị mạng - HK2- Năm học: 2021-2022 - Nhóm 02 - Địa điểm: Phòng  303/C1     
                </div>
                <div class="topic-link">
                    <a href=""><i class="bi bi-file-earmark"></i> tai lieu mon hoc.pdf</a>
                    <a href=""><i class="bi bi-file-earmark"></i> tai lieu mon hoc.pdf</a>
                </div>
            </div>
            <div class="topic-topic">
                <h5 class="topic-title">
                    Bài giảng môn học
                </h5>
            </div>
            
        </div>
    </div>
@endsection