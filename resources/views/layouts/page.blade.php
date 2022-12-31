@extends('base')

@section('body')
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu">
                        <i class="fas fa-bars"></i>
                        <span class="sr-only">ナビゲーションを開閉</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <button type="button" class="btn nav-link dropdown-toggle" data-toggle="dropdown">
                        <span>{{ authUserName() }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="user-footer">
                            <a class="btn btn-default btn-flat float-right btn-block logout-btn">
                                <i class="fa fa-fw fa-power-off"></i>
                                ログアウト
                            </a>
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
                        @foreach (array_keys(GateConst::ROLES) as $role)
                            @can($role)
                                @foreach (ContentConst::SIDEBARS[$role] as $name)
                                    <li class="nav-item">
                                        <a href="{{ url(ContentConst::URLS[$name]) }}" class="nav-link ">
                                            <p>
                                                {{ ContentConst::TITLES[$name] }}
                                            </p>
                                        </a>
                                    </li>
                                @endforeach
                            @endcan
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
                    @include('layouts.alert')

                    <div id="cv-spinner-overlay" class="cv-spinner-overlay">
                        <div class="cv-spinner">
                            <span class="spinner"></span>
                            <p class="spinner-text">更新中です。しばらくお待ちください。</p>
                        </div>
                    </div>

                    <div class="ajax-modal-marks"></div>

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
