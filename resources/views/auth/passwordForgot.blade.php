@extends('layouts.auth')

@section('auth-card')
    <div class="card-header">
        <h3 class="card-title float-none text-center">
            パスワードをリセットする
        </h3>
    </div>

    <div class="card-body login-card-body">
        <form action="{{ route('receiveEmailAddress') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="メールアドレス"
                    autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa-solid fa-envelope"></span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-block btn-flat btn-primary">
                <span class="fa-solid fa-share-from-square"></span>
                リセットリンクを送信する。
            </button>
        </form>
    </div>
@stop
