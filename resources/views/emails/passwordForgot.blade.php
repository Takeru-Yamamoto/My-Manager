@extends('components.email')

@section('text')
    <p>パスワード変更用メールです。</p>
    <p>下記URLからパスワード変更を行ってください</p>
    <p>有効期限は{{ config('email.expiration_minute') }}分です。</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>

    <p><a href="{{ $url }}">パスワード変更用URL</a></p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
@stop
