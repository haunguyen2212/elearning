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
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <h5 class="card-title">Danh sách học sinh</h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <form class="d-flex">
                          <input class="form-control form-control-sm rounded-0 border-main" name="search" placeholder="Tìm kiếm ..." >
                          <button class="btn btn-sm btn-main rounded-0" type="submit">
                            <i class="bi bi-search"></i>
                          </button>
                      </form>
                      </h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <a class="btn btn-sm btn-main" href="{{ route('student.create') }}">
                          <i class="bi bi-person-plus"></i><span class="text-white"> Thêm mới</span> 
                        </a>
                      </h5>
                    </div>
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
                  <div class="table-responsive">
                    <table class="table table-striped" style="min-width: 1100px">
                        <thead>
                          <tr>
                            <th width="5%">STT</th>
                            <th width="10%">Mã số</th>
                            <th width="22.5%">Họ và tên</th>
                            <th width="15%">Ngày sinh</th>
                            <th width="12.5%">Lớp</th>
                            <th width="10%">Phái</th>
                            <th width="10%">Trạng thái</th>
                            <th width="15%">Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($students as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($student->date_of_birth)) }}</td>
                                <td>{{ $student->class_name }}</td>
                                <td>{{ ($student->gender) ? 'Nữ' : 'Nam' }}</td>
                                <td>
                                  @if ($student->active)
                                    <span class="badge bg-success">active</span>
                                  @else
                                    <span class="badge bg-danger">locked</span>
                                  @endif
                                </td>
                                <td>
                                    <a href="{{ route('student.show', ['student' => $student->id]) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('student.edit', ['student' => $student->id]) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $student->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-x-lg"></i></button>
                                    <a href="{{ route('student.pass.edit', ['id' => $student->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-lock"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <div class="pt-3">
                        {{ $students->links() }}
                      </div>
                    </div>
                    <div class="bd-highlight">
                      <a href="{{ route('student.import.create') }}" class="btn btn-sm btn-main">
                        <i class="bi bi-box-arrow-in-left"></i>
                        <span>Import</span> 
                      </a>
                    </div>
                  </div>
                  
                </div>
                
              </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-main" id="deleteModalLabel">Xoá tài khoản</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post">
              @csrf
              @method('delete')
              <h6>Bạn có chắc muốn xóa tài khoản này không ?</h6>
            </form>    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-main" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-sm btn-danger btn-submit">Đồng ý</button>
          </div>
        </div>
      </div>
@endsection

@section('script')
  <script>
    $('#user-nav').addClass('show');
    $('#student').addClass('active');

    $('.btn-delete').click(function(e){
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ asset('/admin/student') }}/"+id;
      $('#deleteModal form').attr('action', url);
    });

    $('.btn-submit').click(function(e){
      e.preventDefault();
      $('#deleteModal form').submit();
    });
  </script>
   
@endsection