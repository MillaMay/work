@extends('trainers.base')
@section('content')
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="float-left"><h5>@lang('tests.title_table')</h5></div>
                <div class="float-right">
                    @isset($lesson_id)
                        <a class="btn btn-success" href="{{route('tests.create', ['lesson_id' => $lesson_id])}}" title="@lang('tests.title_add')">
                    @else
                        <a class="btn btn-success" href="{{route('tests.create')}}" title="@lang('tests.title_add')">
                    @endisset
                        <span class="cil-library-add"></span>
                    </a>
                    <form id="form-delete-all" action="{{ route('tests.destroy', '') }}" class="pull-right" style="display: inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="@lang('tests.button_delete_all')">
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
                                    <th class="text-center">@lang('tests.title_test')</th>
                                    <th class="text-center">@lang('tests.time_test')<br>@lang('tests.transfer')</th>
                                    <th class="text-center">@lang('main.lesson')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tests as $test)
                                        <tr class="odd">
                                            <td>
                                                <label class="c-switch-sm c-switch-info">
                                                    <input class="c-switch-input checked_id" type="checkbox" value="{{$test->id}}" name="check">
                                                    <span class="c-switch-slider"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">{{$test->title}}</td>
                                            <td class="text-center">{{$test->time}}</td>
                                            <td class="text-center">{{$test->lesson->title}}</td>
                                            <td class="text-right" width="15%">
                                                <a class="btn btn-warning" href="{{route('questions.index', ['test_id' => $test->id])}}" title="@lang('tests.icon_questions')"><span class="cil-hand-point-up"></span></a>
                                                <a class="btn btn-info" href="{{route('tests.edit', $test->id)}}" title="@lang('main.button_edit')">
                                                    <span class="cil-pencil"></span>
                                                </a>
                                                {!! Form::open(['route' => ['tests.destroy', $test->id], 'style' => 'display: inline']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                @isset($lesson_id)
                                                    {!! Form::hidden('lesson_id', $test->lesson->id) !!}
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
                            {{ $tests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
