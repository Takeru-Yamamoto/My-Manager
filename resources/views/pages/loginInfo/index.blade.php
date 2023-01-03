@extends('layouts.page.card')

@section('card-header')
    {{ cardHeader('update') }}
@stop

@section('card-body')
    <form method="post" action="{{ url('login_info/update') }}" id="{{ formId() }}">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}" />
        <input type="hidden" name="role" value="{{ $user->role }}" />
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}"
                readonly>
        </div>
        <div class="form-group">
            <label class="d-flex align-items-center flex-wrap">
                メールアドレス
                <a class="{{ btnLinkClass() }}" href="{{ url('login_info/change_email') }}">メールアドレス変更はこちら</a>
            </label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
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
    </form>
@stop

@section('card-footer')
    <a class="{{ btnUpdateClass() }} {{ btnBlock() }} {{ btnFormSubmit() }}"
        data-form="{{ formId() }}">{{ btnUpdateShortText() }}</a>
@stop