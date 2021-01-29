@extends('trainers.base')
@section('content')
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="float-left"><h5>@lang('tasks.title_table')</h5></div>
                <div class="float-right">
                    @isset($lesson_id)
                        <a class="btn btn-success" href="{{route('tasks.create', ['lesson_id' => $lesson_id])}}" title="@lang('tasks.title_add')">
                    @else
                        <a class="btn btn-success" href="{{route('tasks.create')}}" title="@lang('tasks.title_add')">
                    @endisset
                        <span class="cil-library-add"></span>
                    </a>
                    <form id="form-delete-all" action="{{ route('tasks.destroy', '') }}" class="pull-right" style="display: inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="@lang('tasks.button_delete_all')">
                            <span class="cil-trash"></span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered datatable dataTable no-footer" style="border-collapse: collapse !important">
                                <thead>
                                <tr>
                                    <th class="sorting_asc align">
                                        <label class="c-switch-sm c-switch-info" title="@lang('main.checkbox_all')">
                                            <input class="c-switch-input" type="checkbox" id='select_all_invoices' onclick="selectAll()">
                                            <span class="c-switch-slider"></span>
                                        </label>
                                    </th>
                                    <th class="text-center">@lang('tasks.description_task')</th>
                                    <th class="text-center">@lang('tasks.max_point_task')</th>
                                    <th class="text-center">@lang('main.lesson')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr class="odd">
                                            <td>
                                                <label class="c-switch-sm c-switch-info">
                                                    <input class="c-switch-input checked_id" type="checkbox" value="{{$task->id}}" name="check">
                                                    <span class="c-switch-slider"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">{{mb_substr($task->description, 0, 150, 'UTF-8')}}</td>
                                            <td class="text-center">{{$task->max_point}}</td>
                                            <td class="text-center">{{ $task->lesson->title }}</td>
                                            <td class="text-right" width="10%">
                                                <a class="btn btn-info" href="{{route('tasks.edit', $task->id)}}" title="@lang('main.button_edit')">
                                                    <span class="cil-pencil"></span>
                                                </a>
                                                {!! Form::open(['route' => ['tasks.destroy', $task->id], 'style' => 'display: inline']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                @isset($lesson_id)
                                                {!! Form::hidden('lesson_id', $task->lesson->id) !!}
                                                @endisset
                                                <button class="btn btn-danger" title="@lang('main.button_delete')">
                                                    <span class="cil-trash"></span>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
