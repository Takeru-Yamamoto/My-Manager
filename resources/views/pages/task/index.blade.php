@extends('layouts.page.card-noFooter')

@section('card-header')
    {{ tableCardHeader() }}
    {!! btnModalAjax(url('task/task_color'), 0, 'GET', 'タスク分類', btnRight()) !!}
@stop

@section('card-body')
    {!! calendar(url("task/create"), "GET", url("task/update"), "GET", url("task/fetch"), "POST") !!}
@stop
