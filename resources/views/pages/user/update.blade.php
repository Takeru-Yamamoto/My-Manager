@extends('layouts.page.card')

@section('card-header')
    {{ updateCardHeader() }}
@stop

@section('card-body')
    <form method="post" action="{{ url('user/update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}"
                readonly>
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input type="email" name="email" class="form-control" id="email"
                value="{{ old('email', $user->email) }}">
        </div>
        <div class="form-group">
            <label for="password">パスワード(変更時記入)</label>
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
                        {{ isChecked(old('role', $user->role) == 5) }}>
                    <label class="custom-control-label" for="role-5">
                        Admin
                    </label>
                </div>
            @endcan
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="role" value="10" id="role-10"
                    {{ isChecked(old('role', $user->role) == 10) }}>
                <label class="custom-control-label" for="role-10">
                    User
                </label>
            </div>
        </div>
    </form>
@stop

@section('card-footer')
    <a class="{{ btnUpdateClass() }} {{ btnBlock() }} {{ btnFormSubmit() }}"
        data-form="{{ formId() }}">{{ btnUpdateShortText() }}</a>
@stop
