@extends('template.admin')

@section('title', 'Quản lý học sinh')

@section('pagetitle', 'Quản lý học sinh')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tài khoản học sinh</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Danh sách học sinh</h5>
                  <div class="table-responsive">
                    <table class="table table-striped" style="min-width: 1100px">
                        <thead>
                          <tr>
                            <th width="5%">STT</th>
                            <th width="10%">Mã số</th>
                            <th width="20%">Họ và tên</th>
                            <th width="15%">Ngày sinh</th>
                            <th width="10%">Lớp</th>
                            <th width="10%">Phái</th>
                            <th width="15%">Nơi sinh</th>
                            <th width="15%">Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($students as $key => $student)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($student->date_of_birth)) }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ ($student->gender) ? 'Nữ' : 'Nam' }}</td>
                                <td>{{ $student->place_of_birth }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    <button class="btn btn-sm btn-success"><i class="bi bi-lock"></i></button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                  </div>
                  {{ $students->links() }}
                </div>
                
              </div>
        </div>
    </div>
@endsection

@section('script')

@endsection