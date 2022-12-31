@extends('base', ['bodyClass' => 'login-page'])

@section('body')
    <div class="login-box">
        <div class="login-logo">
            @if (isIconView())
                <img src="{{ assetIcon() }}" alt="{{ siteName() }}" height="50">
            @endif
            <span>{{ siteName() }}</span>
        </div>

        <div class="card card-outline card-primary">
            @yield('auth-card')
        </div>
    </div>
@stop
