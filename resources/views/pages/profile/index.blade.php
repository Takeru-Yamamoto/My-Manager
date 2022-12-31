@extends('layouts.page.card')

@section('card-header')
    {{ updateCardHeader() }}
@stop

@section('card-body')
    <form method="post" action="{{ url('profile/update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $profile->id }}" hidden />
        <input type="number" name="created_by" value="{{ $profile->createdBy }}" hidden />
    </form>
@stop

@section('card-footer')
    <a class="{{ btnUpdateClass() }} {{ btnBlock() }} {{ btnFormSubmit() }}"
        data-form="{{ formId() }}">{{ btnUpdateShortText() }}</a>
@stop
