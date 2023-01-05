@extends('layouts.page.card-noFooter')

@section('card-header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{ tableCardHeader() }}
        <div>
            <a class="{{ btnLinkClass() }}"
                href="{{ url('attendance/admin') }}?month={{ $subMonth->format(DateUtil::$FORMAT_MONTH) }}">{{ $subMonth->format(DateUtil::$FORMAT_MONTH_JP) }}</a>
            <a class="{{ btnLinkClass() }}"
                href="{{ url('attendance/admin') }}?month={{ $addMonth->format(DateUtil::$FORMAT_MONTH) }}">{{ $addMonth->format(DateUtil::$FORMAT_MONTH_JP) }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control">
        </div>
    </div>
@stop

@section('card-body')
    @if (is_null($attendanceInMonths))
        <p class="m-0">ユーザがいません。</p>
    @else
        <p class="h4 m-0">{{ $dateUtil->format(DateUtil::$FORMAT_MONTH_JP) }}</p>
        <table class="table table-hover">
            <thead>
                <th width="20%">ユーザ名</th>
                <th width="20%">勤務日数</th>
                <th width="20%">総実働時間</th>
                <th width="20%">総勤務時間</th>
                <th width="20%">総休憩時間</th>
            </thead>
            <tbody>
                @foreach ($attendanceInMonths as $attendanceInMonth)
                    <tr>
                        <td>{{ $attendanceInMonth->user->name }}</td>
                        <td>{{ $attendanceInMonth->attendance->workDays }}</td>
                        <td>{{ round($attendanceInMonth->attendance->totalWorkActual, 2) }}</td>
                        <td>{{ round($attendanceInMonth->attendance->totalWork, 2) }}</td>
                        <td>{{ round($attendanceInMonth->attendance->totalBreak, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $attendanceInMonths->appends(['month' => $form->month, 'name' => $form->name])->links() }}
    @endif
@stop