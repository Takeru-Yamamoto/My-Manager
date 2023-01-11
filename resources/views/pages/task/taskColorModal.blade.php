@extends('layouts.modal')

@section('modal_title')
    タスク分類
@stop

@section('modal_body')
    <table class="table table-hover">
        <thead>
            <th width="40%">タスク分類名</th>
            <th width="20%">色</th>
            <th width="20%"></th>
            <th width="20%"></th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" class="form-control" name="description" id="description">
                </td>
                <td>
                    <select class="form-control colors-select" name="color" id="color">
                        @foreach ($bootstrapColors as $bootstrapColor)
                            <option class="bg-{{ $bootstrapColor }}" value="{{ $bootstrapColor }}">{{ $bootstrapColor }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="{{ btnCreateClass() }} {{ btnBlock() }} task-color-create-btn"
                        data-url="{{ url('task/task_color/create') }}">{{ btnCreateShortText() }}</a>
                </td>
                <td></td>
            </tr>
            @foreach ($taskColors as $taskColor)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="description" value="{{ $taskColor->description }}"
                            id="description{{ $taskColor->id }}">
                    </td>
                    <td>
                        <select class="form-control colors-select bg-{{ $taskColor->color }}" name="color"
                            id="color{{ $taskColor->id }}">
                            @foreach ($bootstrapColors as $bootstrapColor)
                                <option class="bg-{{ $bootstrapColor }}" value="{{ $bootstrapColor }}"
                                    {{ isSelected($taskColor->color === $bootstrapColor) }}>{{ $bootstrapColor }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a class="{{ btnUpdateClass() }} {{ btnBlock() }} task-color-update-btn"
                            data-url="{{ url('task/task_color/update') }}"
                            data-id="{{ $taskColor->id }}">{{ btnUpdateShortText() }}</a>
                    </td>
                    <td>
                        @if (count($taskColors) > 1)
                            @include('components.btn.delete', [
                                'addClass' => btnBlock(),
                                'id'       => $taskColor->id,
                                'type'     => btnTypeShort(),
                                'url'      => url('task/task_color/delete'),
                            ])
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('modal_footer')
    <div class="d-flex align-items-center justify-content-end">
        <a class="btn btn-secondary ml-3" data-dismiss="modal">閉じる</a>
    </div>
@stop
