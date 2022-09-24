@extends('template.admin')

@section('title', 'Năm học')

@section('pagetitle', 'Năm học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Năm học</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách năm học</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#year-link').removeClass('collapsed');
        $('#year-nav').addClass('show');
        $('#list-year').addClass('active');
        $('#list-year').attr('href', 'javascript:void(0)');
    </script>
@endsection