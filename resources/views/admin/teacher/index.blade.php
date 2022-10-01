@extends('template.admin')

@section('title', 'Quản lý giáo viên')

@section('pagetitle', 'Quản lý giáo viên')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tài khoản giáo viên</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <h5 class="card-title">Danh sách giáo viên</h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <form class="d-flex">
                          <input class="form-control form-control-sm rounded-0 border-main" name="search" placeholder="Tìm kiếm ..."  value="{{ request()->search }}">
                          <button class="btn btn-sm btn-main rounded-0" type="submit">
                            <i class="bi bi-search"></i>
                          </button>
                      </form>
                      </h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <a class="btn btn-sm btn-main" href="{{ route('teacher.create') }}">
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
                    <table class="table table-hover" style="min-width: 1100px">
                        <thead>
                          <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Mã số</th>
                            <th width="20%">Họ và tên</th>
                            <th width="10%">Ngày sinh</th>
                            <th width="7.5%">Phái</th>
                            <th width="12.5%">Đơn vị</th>
                            <th width="10%">Điện thoại</th>
                            <th width="10%">Trạng thái</th>
                            <th width="15%">Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($teachers as $key => $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->username }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($teacher->date_of_birth)) }}</td>
                                <td>{{ ($teacher->gender) ? 'Nữ' : 'Nam' }}</td>
                                <td>{{ $teacher->department_name }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>
                                  @if ($teacher->active)
                                    <span class="badge bg-success">active</span>
                                  @else
                                    <span class="badge bg-danger">locked</span>
                                  @endif
                                </td>
                                <td>
                                    <a href="{{ route('teacher.show', ['teacher' => $teacher->id]) }}" 
                                      class="btn btn-sm btn-info"
                                      data-bs-toggle="tooltip"
                                      title="Xem"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('teacher.edit', ['teacher' => $teacher->id]) }}" 
                                      class="btn btn-sm btn-warning"
                                      data-bs-toggle="tooltip"
                                      title="Sửa"
                                    >
                                      <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $teacher->id }}" 
                                      data-bs-toggle="modal" 
                                      data-bs-target="#deleteModal"
                                      title="Xóa"
                                      >
                                      <i class="bi bi-x-lg"></i>
                                    </button>
                                    <a href="{{ route('teacher.pass.edit', ['id' => $teacher->id]) }}" 
                                      class="btn btn-sm btn-success"
                                      data-bs-toggle="tooltip"
                                      title="Đổi mật khẩu"
                                    >
                                      <i class="bi bi-lock"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <div class="pt-3">
                        {{ $teachers->links() }}
                      </div>
                    </div>
                    <div class="bd-highlight">
                      <a href="{{ route('teacher.import.create') }}" class="btn btn-sm btn-primary">
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
    $('#user-link').removeClass('collapsed');
    $('#teacher').addClass('active');
    $('#teacher').attr('href', 'javascript:void(0)');

    $('.btn-delete').click(function(e){
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ asset('/admin/teacher') }}/"+id;
      $('#deleteModal form').attr('action', url);
    });

    $('.btn-submit').click(function(e){
      e.preventDefault();
      $('#deleteModal form').submit();
    });
  </script>
   
@endsection