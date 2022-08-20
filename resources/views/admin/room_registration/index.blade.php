@extends('template.admin')

@section('title', 'Danh sách đăng ký phòng')

@section('pagetitle', 'Danh sách đăng ký phòng')

@section('breadcrumb')
    <li class="breadcrumb-item active">Đăng ký phòng</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách đăng ký</h5>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('#room-registration-nav').removeClass('collapsed');
    </script>
@endsection