@extends('template.master_layout')

@section('title', 'Thông báo')

@section('breadcrumb')
     <li class="breadcrumb-item active">Thông báo</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-title">Tất cả thông báo</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" style="min-width: 600px">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th width="60%">Nội dung</th>
                                    <th width="20%">Thời gian</th>
                                    <th width="15%">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifies as $key => $notifi)
                                    <tr>
                                        <td>{{ ($key + 1) + ($notifies->currentPage() - 1)*$notifies->perPage() }}</td>
                                        <td>{!! $notifi->content !!}</td>
                                        <td>
                                            {{ date('d/m/Y H:i:s', strtotime($notifi->time)) }}
                                            <br>
                                            ({{ \Carbon\Carbon::parse($notifi->time)->diffForHumans() }})
                                        </td>
                                        <td><a href="{{ $notifi->link }}">Xem chi tiết</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                    <div class="d-flex justify-content-center">
                        {{ $notifies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection