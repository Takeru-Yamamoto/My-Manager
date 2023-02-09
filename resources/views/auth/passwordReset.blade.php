@extends('layouts.auth')

@section('auth-card')
    <div class="card-body login-card-body">
        <form action="{{ route('passwordReset') }}" method="post">
            @csrf
            <input type="email" name="email" class="form-control" value="{{ $email }}" hidden>
            <input type="text" name="token" class="form-control" value="{{ $token }}" hidden>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                    placeholder="パスワード" autofocus>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" class="form-control"
                    value="{{ old('password_confirmation') }}" placeholder="もう一度入力" autofocus>
            </div>
            <button type="submit" class="btn btn-block btn-flat btn-primary">
                パスワードをリセットする
            </button>
        </form>
    </div>
@stop
