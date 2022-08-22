@extends('template.admin')

@section('title', 'Xếp lịch')

@section('pagetitle', 'Kết quả xếp lịch')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('schedule.create') }}">Xếp lịch</a></li>
    <li class="breadcrumb-item active">Kết quả</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kết quả xếp lịch</h5>
                    <table class="table table-borderless table-bordered">
                        <thead>
                            <tr align="center">
                                <th></th>
                                @foreach ($period as $date)
                                    <th>{{ date('d/m/Y', strtotime($date)) }} </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room_index => $room)
                                <tr align="center">
                                    <th style="vertical-align: middle">{{ $room['name'].' ('.$room['capacity'].')' }}</th>
                                    @foreach ($period as $date_index => $date)
                                        <td>
                                            @foreach ($schedule[$date_index][$room_index] as $value)
                                                <p>
                                                    <strong>{{ date('H:i', strtotime($value['start_time'])) .' - '. date('H:i', strtotime($value['end_time']))  }}</strong>
                                                    <br><span>{{ $value['purpose'] }}</span>
                                                    <br><span>{{ $value['teacher_name'] }}</span>
                                                    <br><span>Số lượng: {{ $value['amount'] }}</span>
                                                </p>
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
    
@endsection

@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#list-schedule').addClass('active');
        $('#list-schedule').attr('href', 'javascript:void(0)');
    </script>
@endsection