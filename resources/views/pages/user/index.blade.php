@extends('layouts.page.card-noFooter')

@section('card-header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{ tableCardHeader() }}
        <a class="{{ btnRight() }} {{ btnCreateClass() }}" href="{{ url('user/create') }}">{{ btnCreateShortText() }}</a>
    </div>
    <div class="card">
        <form method="get" action="{{ url('user') }}">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <p class="h5 m-0">名前検索</p>
                    <button class="{{ btnInfoClass() }} {{ btnSmall() }}">検索</button>
                </div>
            </div>
            <div class="card-body">
                <input type="text" name="name" class="form-control" value="{{ $form->name }}">
            </div>
        </form>
    </div>
@stop

@section('card-body')
    @if (is_null($users))
        <p class="m-0">ユーザがいません。</p>
    @else
        <table class="table table-hover">
            <thead>
                <th width="55%">ユーザー名</th>
                <th width="15%"></th>
                <th width="15%"></th>
                <th width="15%"></th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            @include('components.btn.flg', [
                                'addClass' => btnBlock(),
                                'flg' => $user->isValid,
                                'id' => $user->id,
                                'type' => btnTypeShort(),
                                'url' => url('user/change_is_valid'),
                            ])
                        </td>
                        <td>
                            <a class="{{ btnUpdateClass() }} {{ btnBlock() }}"
                                href="{{ url('user/update/' . $user->id) }}">{{ btnUpdateShortText() }}</a>
                        </td>
                        <td>
                            @include('components.btn.delete', [
                                'addClass' => btnBlock(),
                                'id' => $user->id,
                                'type' => btnTypeShort(),
                                'url' => url('user/delete'),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->appends(['name' => $form->name])->links() }}
    @endif
@stop
