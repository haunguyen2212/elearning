@extends('template.admin')

@section('title', 'Quản lý lớp học')

@section('pagetitle', 'Quản lý lớp học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Lớp học</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <h5 class="card-title">Lớp học</h5>
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
                        <a class="btn btn-sm btn-main" href="{{ route('class.create') }}">
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
                            <th width="10%">ID</th>
                            <th width="15%">Lớp</th>
                            <th width="35%">Chủ nhiệm</th>
                            <th width="15%">Sỉ số</th>
                            <th width="25%">Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($classes as $class)
                                <tr>
                                    <td>{{ $class->id }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->teacher_name }}</td>
                                    <td>{{ $class->total }}</td>
                                    <td>
                                        <a href="{{ route('class.show', ['class' => $class->id]) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                        <a href="" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-x-lg"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                  </div>
                  {{ $classes->links() }}
                </div>
                
              </div>
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
              <h6>Bạn có chắc muốn xóa lớp học này không ?</h6>
            </form>    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-main" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-sm btn-danger btn-submit">Đồng ý</button>
          </div>
        </div>
      </div> --}}
@endsection


@section('script')
    <script>
        $('#departments-nav').addClass('show');
        $('#classrooms').addClass('active');

        // $('.btn-delete').click(function(e){
        //     e.preventDefault();
        //     let id = $(this).attr('data-id');
        //     let url = "{{ asset('/admin/student') }}/"+id;
        //     $('#deleteModal form').attr('action', url);
        // });

        // $('.btn-submit').click(function(e){
        //     e.preventDefault();
        //     $('#deleteModal form').submit();
        // });
    </script>
@endsection