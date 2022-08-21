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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                                <th>Người đăng ký</th>
                                <th>Thời gian đăng ký</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_registration as $key => $registration)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date('d/m/Y', strtotime($registration->date)) }}</td>
                                        <td>{{ $registration->purpose }}</td>
                                        <td>{{ date('H:i', strtotime($registration->start_time)).' - '.date('H:i', strtotime($registration->end_time)) }}</td>
                                        <td>{{ $registration->teacher_name }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($registration->updated_at)) }}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#list-registration').addClass('active');
        $('#list-registration').attr('href', 'javascript:void(0)');
    </script>
@endsection