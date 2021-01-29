@extends('trainers.base')
@section('content')
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="float-left"><h5>@lang('questions.title_table')</h5></div>
                <div class="float-right">
                    @isset($test_id)
                        <a class="btn btn-success" href="{{route('questions.create', ['test_id' => $test_id])}}" title="@lang('questions.title_add')">
                    @else
                        <a class="btn btn-success" href="{{route('questions.create')}}" title="@lang('questions.title_add')">
                    @endisset
                        <span class="cil-library-add"></span>
                    </a>
                    <form id="form-delete-all" action="{{ route('questions.destroy', '') }}" class="pull-right" style="display: inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="@lang('questions.button_delete_all')">
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
                                    <th class="text-center">@lang('questions.title_test')</th>
                                    <th class="text-center">@lang('questions.title_question')</th>
                                    <th class="text-center">@lang('questions.type_question')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                        <tr class="odd">
                                            <td>
                                                <label class="c-switch-sm c-switch-info">
                                                    <input class="c-switch-input checked_id" type="checkbox" value="{{$question->id}}" name="check">
                                                    <span class="c-switch-slider"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">{{$question->test->title}}</td>
                                            <td class="text-center">{{$question->title}}</td>
                                            <td class="text-center">
                                                @if($question->type == 0)
                                                    @lang('questions.type_checkbox')
                                                @else
                                                    @lang('questions.type_radio')
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-info" href="{{route('questions.edit', $question->id)}}" title="@lang('main.button_edit')">
                                                    <span class="cil-pencil"></span>
                                                </a>
                                                {!! Form::open(['route' => ['questions.destroy', $question->id], 'style' => 'display: inline']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                @isset($test_id)
                                                    {!! Form::hidden('test_id', $question->test->id) !!}
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
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
