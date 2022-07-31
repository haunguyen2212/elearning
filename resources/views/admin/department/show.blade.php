@extends('template.admin')

@section('title', 'Thông tin đơn vị')

@section('pagetitle', 'Chi tiết đơn vị')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('department.index') }}">Đơn vị</a></li>
    <li class="breadcrumb-item active">Xem thông tin</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Thông tin đơn vị</h5>
                <div class="row">
                    <div class="col-12 col-md-6 mb-1">
                        <strong class="text-main">Đơn vị:</strong> {{ $info->name }}
                    </div>
                    <div class="col-12 col-md-6 mb-1">
                        <strong class="text-main">Thành viên:</strong> {{ $total }}
                    </div>
                    <div class="col-12 mt-3 text-center">
                        <h6 class="text-main fw-bold">Danh sách thành viên</h6>
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
                                  </tr>
                                </thead>
                                <tbody>

                                  @foreach ($teachers as $key => $teacher)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $teacher->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($teacher->date_of_birth)) }}</td>
                                        <td>{{ ($teacher->gender) ? 'Nữ' : 'Nam' }}</td>
                                    </tr>
                                  @endforeach
                                  
                                </tbody>
                              </table>
                        </div>     
                    </div>
                    <div class="col-12 text-center mt-2">
                        <a href="{{ route('department.index') }}" class="btn btn-sm btn-main">Trở về</a>
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