@extends('layouts.page.card-noFooter')

@section('card-header')
    {{ tableCardHeader() }}
    @include('components.btn.modalAjax', [
        'addClass' => btnRight(),
        'id'       => 0,
        'text'     => 'タスク分類',
        'type'     => 'GET',
        'url'      => route('taskColor.index'),
    ])
@stop

@section('card-body')
    @include('components.calendar', [
        'createFormUrl'     => route('task.create'),
        'createFormUrlType' => 'GET',
        'fetchUrl'          => route('task.fetch'),
        'fetchUrlType'      => 'POST',
        'updateFormUrl'     => route('task.update'),
        'updateFormUrlType' => 'GET',
    ])
@stop
