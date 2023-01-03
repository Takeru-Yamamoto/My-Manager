@extends('layouts.page.card-noFooter')

@section('card-header')
    {{ tableCardHeader() }}
@stop

@section('card-body')
    {!! taskCalendar() !!}
@stop
