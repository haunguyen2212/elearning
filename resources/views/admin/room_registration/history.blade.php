@extends('template.admin')

@section('title', 'Lịch sử dụng phòng')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/timepicker.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Lịch sử dụng phòng</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Lịch sử dụng phòng</h5>
                        </div>
                        <div>
                            <a href="" class="btn btn-sm btn-warning text-white">Chỉnh sửa</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-bordered" border="1" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th></th>
                                    @foreach ($periods as $date)
                                        <th>{{ date('d/m/Y', strtotime($date)) }} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room_index => $room)
                                    <tr align="center">
                                        <th style="vertical-align: middle">{{ $room['name'].' ('.$room['capacity'].')' }}</th>
                                        @foreach ($periods as $date_index => $date)
                                            <td>
                                                @foreach ($schedule[date('Y-m-d', strtotime($date))] as $value)
                                                    @if ($value->room_id == $room['id'])
                                                        <p>
                                                            <strong>{{ date('H:i', strtotime($value->start_time)) .' - '. date('H:i', strtotime($value->end_time))  }}</strong>
                                                            <br><span>{{ $value->purpose }}</span>
                                                            <br><span>{{ $value->teacher_name }}</span>
                                                            <br><span>Số lượng: {{ $value->amount }}</span>
                                                        </p>
                                                    @endif
                                                    
                                                @endforeach
                                            </td>
                                        @endforeach
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
        $('#history-schedule').addClass('active');
        $('#history-schedule').attr('href', 'javascript:void(0)');
    </script>
@endsection

