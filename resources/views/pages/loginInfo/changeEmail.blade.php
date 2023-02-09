@extends('layouts.page.card')

@section('card-header')
    E-Mail 変更フォーム
@stop

@section('card-body')
    <form method="get" action="{{ route('login_info.authenticationCodeForm') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="user_id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <label>変更後メールアドレス</label>
            <input type="email" name="email" class="form-control">
        </div>
    </form>
@stop

@section('card-footer')
    <a class="{{ btnCreate() }} {{ btnBlock() }} {{ btnFormSubmit() }}" data-form="{{ formId() }}">認証画面に進む</a>
@stop
