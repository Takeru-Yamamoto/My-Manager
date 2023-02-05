@extends('base', ['bodyClass' => 'login-page'])

@section('body')
    <div class="login-box">
        <div class="login-logo">
            @if (config("application.is_icon_view"))
                <img src="{{ config("application.icon_directory") }}" alt="{{ config("application.site_name") }}" height="50">
            @endif
            <span>{{ config("application.site_name") }}</span>
        </div>

        @if (sessionHas('success_message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fa-solid fa-check"></i> Success</h5>
                {!! enl2br(sessionGet('success_message')) !!}
            </div>
        @endif
        @if (sessionHas('danger_message'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fa-solid fa-xmark"></i> Failure</h5>
                {!! enl2br(sessionGet('danger_message')) !!}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fa-solid fa-xmark"></i> Errors</h5>
                {!! enl2br(implode("\n", $errors->all())) !!}
            </div>
        @endif

        <div class="card card-outline card-primary">
            @yield('auth-card')
        </div>
    </div>
@stop
