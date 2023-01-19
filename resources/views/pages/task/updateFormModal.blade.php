@extends('components.modal')

@section('modal_title')
    タスク編集
@stop

@section('modal_body')
    <form method="post" action="{{ url('task/update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $task->id }}" hidden>

        <div class="form-group">
            <label for="start_date">開始日</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ old('start_date', $task->startDate) }}">
        </div>
        <div class="form-group">
            <label for="end_date">終了日</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                value="{{ old('end_date', $task->endDate) }}">
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $task->title) }}">
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="5">{{ old('comment', $task->comment) }}</textarea>
        </div>
        <div class="form-group">
            <label for="color_id">タスク分類</label>
            <select class="form-control" name="color_id" id="color_id">
                @foreach ($taskColors as $taskColor)
                    <option class="bg-{{ $taskColor->color }}" value="{{ $taskColor->id }}"
                        {{ isSelected(old('color_id', $task->colorId) === $taskColor->id) }}>
                        {{ $taskColor->description }}</option>
                @endforeach
            </select>
        </div>
    </form>
@stop

@section('modal_footer')
    <div class="d-flex align-items-center justify-content-end">
        <a class="{{ btnUpdateClass() }} {{ btnFormSubmit() }}"
            data-form="{{ formId() }}">{{ btnUpdateShortText() }}</a>
        @include('components.btn.delete', [
            'addClass' => 'ml-3',
            'id'       => $$task->id,
            'type'     => btnTypeShort(),
            'url'      => url('task/delete'),
        ])
        <a class="btn btn-secondary ml-3" data-dismiss="modal">キャンセル</a>
    </div>
@stop
