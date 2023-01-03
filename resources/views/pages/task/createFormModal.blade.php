@extends('layouts.modal', ['id' => 'modal'])

@section('modal_title')
    タスク追加
@stop

@section('modal_body')
    <form method="post" action="{{ url('task/create') }}" id="{{ formId() }}">
        @csrf
        <input type="text" name="start_date" value="{{ $form->startDate }}" hidden>
        <input type="text" name="end_date" value="{{ $form->endDate }}" hidden>

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="5">{{ old('comment') }}</textarea>
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