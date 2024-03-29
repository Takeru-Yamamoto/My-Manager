@extends('layouts.auth')

@section('auth-card')
    <div class="card-header">
        <h3 class="card-title float-none text-center">
            ログインしてセッションを開始する
        </h3>
    </div>

    <div class="card-body login-card-body">
        <form action="{{ route('login') }}" method="post">
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

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="パスワード">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa-solid fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-7">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">パスワードを記憶する</label>
                    </div>
                </div>
                <div class="col-5">
                    <button type=submit class="btn btn-block btn-flat btn-primary">
                        <span class="fa-solid fa-right-to-bracket"></span>
                        ログイン
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-footer">
        <p class="my-0">
            <a href="{{ route('showEmailInputForm') }}">
                パスワードを忘れた方はこちら
            </a>
        </p>
    </div>
@stop
