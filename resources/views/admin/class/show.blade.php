@extends('template.admin')

@section('title', 'Thông tin lớp học')

@section('pagetitle', 'Chi tiết lớp học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('class.index') }}">Lớp học</a></li>
    <li class="breadcrumb-item active">Xem thông tin</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Thông tin lớp học</h5>
                <div class="row">
                    <div class="col-12 col-md-3 mb-1">
                        <strong class="text-main">Lớp:</strong> {{ $info->name }}
                    </div>
                    <div class="col-12 col-md-6 mb-1">
                        <strong class="text-main">Chủ nhiệm:</strong> {{ $homeroomTeacherActive }}
                    </div>
                    <div class="col-12 col-md-3 mb-1">
                        <strong class="text-main">Sỉ số:</strong> {{ $total }}
                    </div>
                    <div class="col-12 mt-3 text-center">
                        <h6 class="text-main fw-bold">Danh sách lớp</h6>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-borderless table-bordered" style="min-width: 700px">
                                <thead>
                                  <tr>
                                    <th>STT</th>
                                    <th>Họ và tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Nơi sinh</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  @foreach ($students as $key => $student)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($student->date_of_birth)) }}</td>
                                        <td>{{ ($student->gender) ? 'Nữ' : 'Nam' }}</td>
                                        <td>{{ $student->place_of_birth }}</td>
                                    </tr>
                                  @endforeach
                                  
                                </tbody>
                              </table>
                        </div>     
                    </div>
                    <div class="col-12 text-center mt-2">
                        <a href="{{ route('class.index') }}" class="btn btn-sm btn-main">Trở về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#departments-nav').addClass('show');
        $('#classrooms').addClass('active');
    </script>
@endsection