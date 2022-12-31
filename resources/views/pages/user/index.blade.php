@extends('layouts.page.card-table')

@section('card-header')
    {{ tableCardHeader() }}
    <a class="{{ btnRight() }} {{ btnCreateClass() }}" href="{{ url('user/create') }}">{{ btnCreateShortText() }}</a>
@stop

@section('table-header')
    <th width="55%">ユーザー名</th>
    <th width="15%"></th>
    <th width="15%"></th>
    <th width="15%"></th>
@stop

@section('table-body')
    @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {!! btnFlg(url('user/change_is_valid'), $user->id, $user->isValid) !!}
            </td>
            <td>
                <a class="{{ btnUpdateClass() }}" href="{{ url('user/update/' . $user->id) }}">{{ btnUpdateShortText() }}</a>
            </td>
            <td>
                {!! btnDelete(url('user/delete'), $user->id) !!}
            </td>
        </tr>
    @endforeach
@stop