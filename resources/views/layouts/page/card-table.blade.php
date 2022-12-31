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
                    <table class="table table-hover">
                        <thead>
                            @yield('table-header')
                        </thead>
                        <tbody>
                            @yield('table-body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
