@extends('layouts.page.card-noFooter')

@section('card-header')
    {{ tableCardHeader() }}
    <a class="{{ btnRight() }} {{ btnCreateClass() }}" href="{{ url('user/create') }}">{{ btnCreateShortText() }}</a>
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
                            'flg'      => $user->isValid,
                            'id'       => $user->id,
                            'type'     => btnTypeShort(),
                            'url'      => url('user/change_is_valid'),
                        ])
                    </td>
                    <td>
                        <a class="{{ btnUpdateClass() }} {{ btnBlock() }}"
                            href="{{ url('user/update/' . $user->id) }}">{{ btnUpdateShortText() }}</a>
                    </td>
                    <td>
                        @include('components.btn.delete', [
                            'addClass' => btnBlock(),
                            'id'       => $user->id,
                            'type'     => btnTypeShort(),
                            'url'      => url('user/delete'),
                        ])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->appends([])->links() }}
    @endif
@stop
