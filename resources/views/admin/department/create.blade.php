@extends('template.admin')

@section('title', 'Thêm mới đơn vị')

@section('pagetitle', 'Thêm mới đơn vị')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('department.index') }}">Đơn vị</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thêm đơn vị</h5>

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

                    <form action="{{ route('department.store') }}" method="post" class="row g-3">
                      @csrf

                        <div class="col-12">
                          <label for="name" class="form-label">Tên đơn vị (*)</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                          @error('name')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>
                        
                        <div class="text-center mt-4">
                          <button type="submit" class="btn btn-sm btn-primary">Thêm mới</button>
                          <a href="{{ route('department.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#departments-nav').addClass('show');
        $('#departments').addClass('active');
    </script>
@endsection