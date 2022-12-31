@extends('layouts.components.email')

@section('text')
    <p>パスワード変更用メールです。</p>
    <p>下記URLからパスワード変更を行ってください</p>
    <p>有効期限は{{ MailConst::EXPIRATION_MINUTE }}分です。</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>

    <p><a href="{{ $url }}">パスワード変更用URL</a></p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
@stop
