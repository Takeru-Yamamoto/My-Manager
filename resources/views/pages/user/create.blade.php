@extends('layouts.page.card')

@section('card-header')
    {{ createCardHeader() }}
@stop

@section('card-body')
    <form method="post" action="{{ route('user.create') }}" id="{{ formId() }}">
        @csrf
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード確認用</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                value="{{ old('password_confirmation') }}">
        </div>
        <label for="role">ロール</label>
        <div class="form-group" id="role">
            @can('system')
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="role" value="5" id="role-5"
                        {{ isChecked(old('role') == '5') }}>
                    <label class="custom-control-label" for="role-5">
                        Admin
                    </label>
                </div>
            @endcan
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="role" value="10" id="role-10"
                    {{ isChecked(empty(old('role')) || old('role') == '10') }}>
                <label class="custom-control-label" for="role-10">
                    User
                </label>
            </div>
        </div>
    </form>
@stop

@section('card-footer')
    <a class="{{ btnCreate() }} {{ btnBlock() }} {{ btnFormSubmit() }}"
        data-form="{{ formId() }}">{{ btnCreateText() }}</a>
@stop
