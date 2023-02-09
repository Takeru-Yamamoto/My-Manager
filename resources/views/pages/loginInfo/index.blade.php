@extends('layouts.page.card')

@section('card-header')
    {{ updateCardHeader() }}
@stop

@section('card-body')
    <form method="post" action="{{ route('loginInfo.update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $user->id }}" hidden />
        <input type="number" name="role" value="{{ $user->role }}" hidden />
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}"
                readonly>
        </div>
        <div class="form-group">
            <label class="d-flex align-items-center">
                メールアドレス
                <a class="{{ btnLink() }}" href="{{ route('loginInfo.changeEmailForm') }}">メールアドレス変更はこちら</a>
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
    <a class="{{ btnUpdate() }} {{ btnBlock() }} {{ btnFormSubmit() }}"
        data-form="{{ formId() }}">{{ btnUpdateText() }}</a>
@stop
