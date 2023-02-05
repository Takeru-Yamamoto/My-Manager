@extends('layouts.page.card-noFooter')

@section('card-header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{ tableCardHeader() }}
        <div>
            <a class="{{ btnLink() }}"
                href="{{ url('attendance/admin?month=' . $subMonth->format(config("library.date.format.year_month"))) }}&name={{ $form->name }}">{{ $subMonth->format(config("library.date.format.year_month_jp")) }}</a>
            <a class="{{ btnLink() }}"
                href="{{ url('attendance/admin?month=' . $addMonth->format(config("library.date.format.year_month"))) }}&name={{ $form->name }}">{{ $addMonth->format(config("library.date.format.year_month_jp")) }}</a>
        </div>
    </div>
    <div class="card">
        <form method="get" action="{{ url('attendance/admin') }}">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <p class="h5 m-0">ユーザー検索</p>
                    <button class="{{ btnInfo() }} {{ btnSmall() }}">検索</button>
                </div>
            </div>
            <div class="card-body">
                <input type="month" name="month" value="{{ $form->month }}" hidden>

                <div class="row">
                    <div class="col-8">
                        <label for="name">ユーザー名</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $form->name }}">
                    </div>
                    <div class="col-4">
                        <label for="is_valid">有効/無効</label>
                        <select class="form-control" name="is_valid" id="is_valid">
                            <option>選択してください。</option>
                            <option value="1" {{ !is_null($form->isValid) && $form->isValid === 1 ? 'selected' : '' }}>
                                有効
                            </option>
                            <option value="0" {{ !is_null($form->isValid) && $form->isValid === 0 ? 'selected' : '' }}>
                                無効
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('card-body')
    @if (is_null($attendanceInMonths))
        <p class="m-0">ユーザがいません。</p>
    @else
        <p class="h4 m-0">{{ $dateUtil->format(config("library.date.format.year_month_jp")) }}</p>
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
        {{ $attendanceInMonths->appends(['month' => $form->month, 'name' => $form->name, 'is_valid' => $form->isValid])->links() }}
    @endif
@stop
