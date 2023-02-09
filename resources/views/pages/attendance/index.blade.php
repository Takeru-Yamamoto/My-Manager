@extends('layouts.page.card-noFooter')

@section('card-header')
    <div class="d-flex justify-content-between align-items-center">
        {{ tableCardHeader() }}
        <div>
            <a class="{{ btnLink() }}"
                href="{{ route('attendance.index', ['month' => $subMonth->format(config('library.date.format.year_month'))]) }}">{{ $subMonth->format(config('library.date.format.year_month_jp')) }}</a>
            <a class="{{ btnLink() }}"
                href="{{ route('attendance.index', ['month' => $addMonth->format(config('library.date.format.year_month'))]) }}">{{ $addMonth->format(config('library.date.format.year_month_jp')) }}</a>
        </div>
    </div>
@stop

@section('card-body')
    <p class="h4 m-0">{{ $dateUtil->format(config('library.date.format.year_month_jp')) }}</p>
    <table class="table table-hover">
        <thead>
            <th width="25%">勤務日数</th>
            <th width="25%">総実働時間</th>
            <th width="25%">総勤務時間</th>
            <th width="25%">総休憩時間</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $attendanceInMonth->workDays }}</td>
                <td>{{ round($attendanceInMonth->totalWorkActual, 2) }}</td>
                <td>{{ round($attendanceInMonth->totalWork, 2) }}</td>
                <td>{{ round($attendanceInMonth->totalBreak, 2) }}</td>
            </tr>
        </tbody>
    </table>

    @if (!is_null($attendances))
        <p class="h4 m-0">ログ</p>
        <table class="table table-hover">
            <thead>
                <th width="40%">種別</th>
                <th width="60%">時刻</th>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ getAttendanceTypeText($attendance->type) }}</td>
                        <td>{{ $attendance->datetime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $attendances->appends(['month' => $form->month])->links() }}

    @endif
@stop
