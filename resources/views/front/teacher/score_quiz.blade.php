@extends('template.master')

@section('title', 'Bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.teacher', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item"> <a href="{{ route('teacher.quiz.index', ['course_id' => $course->id, 'id' => $quiz->id]) }}">{{ $quiz->name }}</a></li>
    <li class="breadcrumb-item active">Kết quả thi</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="bd-highlight">
                <div class="card-title mb-0">{{ $quiz->name }}</div>
             </div>
             <div class="bd-highlight">
                <div class="text-main mb-0">
                    <a href="{{ route('teacher.quiz.score.export',[$course->id, $quiz->id]) }}" class="btn-slide01">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM7.86 14.841a1.13 1.13 0 0 0 .401.823c.13.108.29.192.479.252.19.061.411.091.665.091.338 0 .624-.053.858-.158.237-.105.416-.252.54-.44a1.17 1.17 0 0 0 .187-.656c0-.224-.045-.41-.135-.56a1.002 1.002 0 0 0-.375-.357 2.028 2.028 0 0 0-.565-.21l-.621-.144a.97.97 0 0 1-.405-.176.37.37 0 0 1-.143-.299c0-.156.061-.284.184-.384.125-.101.296-.152.513-.152.143 0 .266.023.37.068a.624.624 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.093 1.093 0 0 0-.199-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.552.05-.777.15-.224.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.123.524.082.149.199.27.351.367.153.095.332.167.54.213l.618.144c.207.049.36.113.462.193a.387.387 0 0 1 .153.326.512.512 0 0 1-.085.29.558.558 0 0 1-.255.193c-.111.047-.25.07-.413.07-.117 0-.224-.013-.32-.04a.837.837 0 0 1-.249-.115.578.578 0 0 1-.255-.384h-.764Zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036l.823-1.438Zm1.923 3.325h1.697v.674H5.266v-3.999h.791v3.325Zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036l.823-1.438Z"/>
                          </svg>
                        &nbsp; Xuất kết quả</a> 
                </div>
             </div>
        </div>
        
        <div class="card-content">
            Kết quả {{ $quiz->name }} (làm tròn 2 chữ số thập phân)
            <div class="table-responsive">
                <table class="table" style="min-width: 1200px">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th width="10%">Mã số</th>
                            <th width="25%">Họ và tên</th>
                            <th width="15%">Thời gian bắt đầu</th>
                            <th width="15%">Thời gian nộp bài</th>
                            <th width="10%">Số câu đúng</th>
                            <th width="10%">Tổng số câu</th>
                            <th width="10%">Điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listStudent as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    @foreach ($scores[$student->id] as $score)
                                        @if (!empty($score))
                                            <span>{{ date('d/m/Y H:i:s', strtotime($score->start_time)) }}</span> <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($scores[$student->id] as $score)
                                        @if (!empty($score))
                                            <span>{{ $score->submit_time ? date('d/m/Y H:i:s', strtotime($score->submit_time)) : '' }}</span> <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($scores[$student->id] as $score)
                                        @if (!empty($score))
                                            <span class="ps-4">{{ $score->number_correct }}</span> <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($scores[$student->id] as $score)
                                        @if (!empty($score))
                                            <span class="ps-4">{{ $score->total }}</span> <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($scores[$student->id] as $score)
                                        @if (!empty($score))
                                            <strong>{{ $score->score }}</strong> <br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection