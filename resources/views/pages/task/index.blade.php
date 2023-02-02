@extends('layouts.page.card-noFooter')

@section('card-header')
    {{ tableCardHeader() }}
    @include('components.btn.modalAjax', [
        'addClass' => btnRight(),
        'id'       => 0,
        'text'     => 'タスク分類',
        'type'     => 'GET',
        'url'      => url('task_color'),
    ])
@stop

@section('card-body')
    @include('components.calendar', [
        'createFormUrl'     => url('task/create'),
        'createFormUrlType' => 'GET',
        'fetchUrl'          => url('task/fetch'),
        'fetchUrlType'      => 'POST',
        'updateFormUrl'     => url('task/update'),
        'updateFormUrlType' => 'GET',
    ])
@stop
