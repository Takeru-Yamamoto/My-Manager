@extends('layouts.page.card')

@section('card-header')
    {{ updateCardHeader() }}
@stop

@section('card-body')
    <form method="post" action="{{ route('login_info.update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
        </div>
        <div class="form-group">
            @if (authUser()->can(RoleConst::ADMIN_HIGHER))
                <label for="email">メールアドレス</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @else
                <label class="d-flex align-items-center">
                    メールアドレス
                    <a class="{{ btnLink() }}" href="{{ route('login_info.changeEmailForm') }}">メールアドレス変更はこちら</a>
                </label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
            @endif
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
