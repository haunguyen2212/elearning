@extends('template.admin')

@section('title', 'Import tài khoản học sinh')

@section('pagetitle', 'Import tài khoản học sinh')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Tài khoản học sinh</a></li>
    <li class="breadcrumb-item active">Import Excel</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Import tài khoản</h5>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('failures'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-check2-circle"></i> Import dữ liệu thành công <br>
                        <i class="bi bi-exclamation-triangle"></i> Một số tài khoản import thất bại do dữ liệu không hợp lệ, vui lòng cập nhật lại các dòng bên dưới: <br>
                        <table class="table table-borderless">
                            <thead>
                                <th>Dòng</th>
                                <th>Giá trị</th>
                                <th>Thông báo</th>
                            </thead>
                            <tbody>
                                @foreach (session()->get('failures') as $error)
                                <tr>
                                    <td>{{ $error->row() }}</td>
                                    <td>{{ $error->values()[$error->attribute()] }}</td>
                                    <td>{{ $error->errors()[0] }}</td>
                                </tr>
                                    
                            @endforeach
                            </tbody>
                        </table>
                            
                        
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                    @endif
                    
                    <form action="{{ route('student.import.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                      @csrf
                        <div class="col-12">
                          <label for="file" class="form-label">Chọn file (xlsx)</label>
                          <input type="file" class="form-control" name="file" id="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                          @error('file')
                            <div class="text-danger pt-1">{!! $message !!}</div>
                          @enderror
                        </div>
                        

                        <div class="text-center">
                          <button type="submit" class="btn btn-sm btn-success">Import</button>
                          <a href="{{ route('student.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#user-nav').addClass('show');
        $('#student').addClass('active');
    </script>
@endsection