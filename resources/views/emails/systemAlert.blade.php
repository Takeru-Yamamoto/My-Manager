@extends('layouts.email')

@section('text')
    <p>System Alert</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>

    <p>Error Message</p>
    <p>{{ $throwable->getMessage() }}</p>
    <p></p>
    <p>Code: {{ $throwable->getCode() }}</p>
    <p>File: {{ $throwable->getFile() }}</p>
    <p>Line: {{ $throwable->getLine() }}</p>
    <p>URL: {{ url()->full() }}</p>
    <p>Exception Class: {{ className($throwable) }}</p>
    <p></p>
    <p>Stack Trace</p>
    @foreach (explode("\n", $throwable->getTraceAsString()) as $trace)
        <p>{{ $trace }}</p>
    @endforeach

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
@stop
