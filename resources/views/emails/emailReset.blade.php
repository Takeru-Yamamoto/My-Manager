@extends('layouts.components.email')

@section('text')
    <p>メールアドレス変更の確認用メールです。</p>
    <p>管理画面でコードを入力し、認証を完了させてください。</p>
    <p>有効期限は{{ MailConst::EXPIRATION_MINUTE }}分です。</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>

    <p>確認用コード {{ $authenticationCode }}</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
@stop
