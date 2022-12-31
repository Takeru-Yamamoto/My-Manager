@extends('layouts.page.card')

@section('card-header')
    認証用コード入力画面
@stop

@section('card-body')
    <p>入力されたメールアドレス宛に認証用コードが記載されたメールが送信されました。</p>
    <p>メールに記載された認証コードを入力してください。</p>
    <p>有効期限は30分です。</p>

    @if (isset($auth) && !$auth)
        <p class="text-danger">認証に失敗しました。</p>
        <p class="text-danger">もう一度入力しなおしてください。</p>
    @endif
    <form method="post" action="{{ url('login_info/change_email') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="user_id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <div class="d-flex">
                <label>認証用コード</label>
            </div>
            <input type="text" name="authentication_code" class="form-control">
        </div>
    </form>
@stop

@section('card-footer')
    <a class="{{ btnCreateClass() }} {{ btnBlock() }} {{ btnFormSubmit() }}"
        data-form="{{ formId() }}">送信</a>
@stop
