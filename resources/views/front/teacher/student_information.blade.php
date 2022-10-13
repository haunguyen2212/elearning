@extends('template.master_layout')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('course.view.teacher', $course->id) }}">{{ $course->name }}</a></li>
     <li class="breadcrumb-item active">Thông tin học sinh</li>
@endsection

@section('right')
    @if (isset($listStudent))
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Danh sách học sinh</h5>
                <ul class="list-item ps-0 mb-0">
                    @foreach ($listStudent as $student)
                        <div class="d-flex justify-content-between student-name-wrap">
                        <div class="student-name">
                            <a href="{{ route('course.view.student_information', [$course->id, $student->id]) }}">
                            @if ($student->active == 1)
                                <i class="bi bi-person"></i>
                            @else
                                <i class="bi bi-person-x"></i>
                            @endif
                            {{ $student->username .' - '. $student->name }}
                            </a>
                        </div>
                        <div class="student-control">
                            <i class="bi bi-dash-circle delete-student" 
                                data-bs-toggle="modal" 
                                data-bs-target="#ModalDeleteStudent" 
                                data-url="{{ route('course.teacher.delete_student', ['course_id' => $course->id, 'student_id' => $student->id]) }}"
                                title="Xóa khỏi khóa học"></i>
                        </div>
                        </div>
                    @endforeach
                </ul> 
            </div>
        </div>
    </div>
    @include('front.teacher.modal.delete_student')            
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                         <div class="bd-highlight">
                              <h5 class="card-title">Thông tin học sinh</h5>
                          </div>
                    </div>
                    <div class="row">
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Mã học sinh: </strong>
                              <span>{{ $info->username }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Họ và tên: </strong>
                              <span>{{ $info->name }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Lớp: </strong>
                              <span>{{ $info->class_name }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Ngày sinh: </strong>
                              <span>{{ date('d/m/Y', strtotime($info->date_of_birth)) }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Nơi sinh: </strong>
                              <span>{{ $info->place_of_birth }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Giới tính: </strong>
                              <span>{{ $info->gender == 0 ? 'Nam' : 'Nữ' }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-8 mt-2">
                              <strong class="text-main">Địa chỉ: </strong>
                              <span>{{ $info->address }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Điện thoại: </strong>
                              <span>{{ $info->phone }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-8 mt-2">
                              <strong class="text-main">Email: </strong>
                              <span>{{ $info->email }}</span>
                         </div>
                         <div class="col-12 col-sm-6 col-md-4 mt-2">
                              <strong class="text-main">Trạng thái: </strong>
                              @if ($info->active == 1)
                                   <span class="text-success fw-bold">Hoạt động</span>
                              @else
                                   <span class="text-danger fw-bold">Bị khóa</span>
                              @endif
                         </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                         <a href="{{ route('course.view.teacher', $course->id) }}" class="btn-slide01">Về khóa học</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
     <script>
          var url_back = "{{ route('course.view.teacher', $course->id) }}";
     </script>
     <script src="{{ asset('frontend/assets/js/course/teacher.js') }}"></script>
@endsection