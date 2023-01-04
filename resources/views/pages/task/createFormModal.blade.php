@extends('layouts.modal', ['id' => 'modal'])

@section('modal_title')
    タスク追加

@stop

@section('modal_body')
    <form method="post" action="{{ url('task/create') }}" id="{{ formId() }}">
        @csrf
        <div class="form-group">
            <label for="start_date">開始日</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ old('start_date', $form->startDate) }}">
        </div>
        <div class="form-group">
            <label for="end_date">終了日</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                value="{{ old('end_date', $form->endDate) }}">
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="5">{{ old('comment') }}</textarea>
        </div>
        <div class="form-group">
            <label for="color_id">タスク分類</label>
            <select class="form-control" name="color_id" id="color_id">
                @foreach ($taskColors as $taskColor)
                    <option class="bg-{{ $taskColor->color }}" value="{{ $taskColor->id }}">
                        {{ $taskColor->description }}</option>
                @endforeach
            </select>
        </div>
    </form>
@stop

@section('modal_footer')
    <div class="d-flex align-items-center justify-content-end">
        <a class="{{ btnCreateClass() }} {{ btnFormSubmit() }}"
            data-form="{{ formId() }}">{{ btnCreateShortText() }}</a>
        <a class="btn btn-secondary ml-3" data-dismiss="modal">キャンセル</a>
    </div>
@stop
