@extends('base')

@section('body')
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu">
                        <i class="fa-solid fa-bars"></i>
                        <span class="sr-only">ナビゲーションを開閉</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a class="nav-link dropdown-toggle pointer" data-toggle="dropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span>{{ isLoggedIn() ? authUserName() : 'ゲスト' }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                        <li class="user-footer">
                            @if (isLoggedIn())
                                <a class="btn btn-default btn-flat float-right btn-block logout-btn">
                                    <i class="fa-solid fa-power-off"></i>
                                    ログアウト
                                </a>
                            @else
                                <a class="btn btn-default btn-flat float-right btn-block" href="{{ url('login') }}">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    ログイン
                                </a>
                            @endif
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('home') }}" class="brand-link">
                @if (isIconView())
                    <img src="{{ assetIcon() }}" alt="{{ siteName() }}" class="brand-image img-circle elevation-3">
                @endif
                <span class="brand-text font-weight-light">{{ siteName() }}</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @foreach (ContentConst::SIDEBARS[role()] as $name)
                            <li class="nav-item">
                                <a href="{{ url(ContentConst::URLS[$name]) }}"
                                    class="nav-link {{ isset(ContentConst::SIDEBAR_CLASSES[role()][$name]) ? ContentConst::SIDEBAR_CLASSES[role()][$name] : '' }}">
                                    @if (isset(ContentConst::SIDEBAR_ICONS[$name]))
                                        <i class="{{ ContentConst::SIDEBAR_ICONS[$name] }}"></i>
                                    @endif
                                    <p>
                                        {{ contentHeader($name) }}
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>{{ contentHeader() }}</h1>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
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

                    @yield('modal')
                    @yield('contents')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <p class="m-0 text-right">{{ pageFooter() }}</p>
        </footer>
    </div>
@stop
