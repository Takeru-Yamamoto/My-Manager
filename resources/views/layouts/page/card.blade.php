@extends('layouts.page')

@section('contents')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>
                        @yield('card-header')
                    </h4>
                </div>
                <div class="card-body">
                    @yield('card-body')
                </div>
                <div class="card-footer">
                    @yield('card-footer')
                </div>
            </div>
        </div>
    </div>
@stop
