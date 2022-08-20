@extends('template.admin')

@section('title', 'Quản lý đơn vị')

@section('pagetitle', 'Quản lý đơn vị')

@section('breadcrumb')
    <li class="breadcrumb-item active">Đơn vị</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <h5 class="card-title">Đơn vị</h5>
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
                        <a class="btn btn-sm btn-main" href="{{ route('department.create') }}">
                          <i class="bi bi-plus"></i><span class="text-white"> Thêm mới</span> 
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
                    <table class="table table-striped" style="min-width: 100px">
                        <thead>
                          <tr>
                            <th width="15%">ID</th>
                            <th width="50%">Đơn vị</th>
                            <th width="15%">SL</th>
                            <th width="20%">Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td class="ps-3">{{ $department->total }}</td>
                                    <td>
                                        <a 
                                          href="{{ route('department.show' , ['department' => $department->id]) }}" 
                                          class="btn btn-sm btn-info"
                                          data-bs-toggle="tooltip"
                                          title="Xem"
                                        >
                                          <i class="bi bi-eye"></i>
                                        </a>
                                        <a 
                                          href="{{ route('department.edit', ['department' => $department->id]) }}" 
                                          class="btn btn-sm btn-warning"
                                          data-bs-toggle="tooltip"
                                          title="Sửa"
                                        >
                                          <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button 
                                          class="btn btn-sm btn-danger btn-delete" 
                                          data-id="{{ $department->id }}" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#deleteModal"
                                          title="Xóa"
                                        >
                                          <i class="bi bi-x-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                  </div>
                  {{ $departments->links() }}
                </div>
                
              </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-main" id="deleteModalLabel">Xoá lớp học</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post">
              @csrf
              @method('delete')
              <h6>Các giáo viên trong đơn vị này sẽ không còn trong đơn vị nữa. Bạn có chắc muốn xóa đơn vị này không ?</h6>
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
        $('#departments-nav').addClass('show');
        $('#departments').addClass('active');

        $('.btn-delete').click(function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ asset('/admin/department') }}/"+id;
            $('#deleteModal form').attr('action', url);
        });

        $('.btn-submit').click(function(e){
            e.preventDefault();
            $('#deleteModal form').submit();
        });
    </script>
@endsection