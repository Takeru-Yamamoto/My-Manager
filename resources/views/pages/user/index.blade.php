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
                    <p class="h5 m-0">ユーザー検索</p>
                    <button class="{{ btnInfoClass() }} {{ btnSmall() }}">検索</button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-group w-50">
                        <label for="name">ユーザー名</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $form->name }}">
                    </div>
                    <div class="form-group w-25">
                        <label for="is_valid">有効/無効</label>
                        <select class="form-control" name="is_valid" id="is_valid">
                            <option>選択してください。</option>
                            <option value="1" {{ !is_null($form->isValid) && $form->isValid === 1 ? 'selected' : '' }}>
                                有効
                            </option>
                            <option value="0" {{ !is_null($form->isValid) && $form->isValid === 0 ? 'selected' : '' }}>
                                無効
                            </option>
                        </select>
                    </div>
                </div>
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
        {{ $users->appends(['name' => $form->name, 'is_valid' => $form->isValid])->links() }}
    @endif
@stop
