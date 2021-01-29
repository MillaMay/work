@extends('trainers.base')
@section('content')
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="float-left"><h5>@lang('courses.title_table')</h5></div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{route('courses.create')}}" title="@lang('courses.title_add')">
                        <span class="cil-library-add"></span>
                    </a>
                    <form id="form-delete-all" action="{{ route('courses.destroy', '') }}" class="pull-right" style="display: inline" method="POST">
                        @csrf {{--Если без Form::open(), то это для токена нужно вставить--}}
                        @method('DELETE')
                        <button class="btn btn-danger" title="@lang('courses.button_delete_all')">
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
                                    <th class="text-center">@lang('courses.logo_course')</th>
                                    <th class="text-center">@lang('courses.title_course')</th>
                                    <th class="text-center">@lang('courses.description_course')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr class="odd">
                                            <td>
                                                <label class="c-switch-sm c-switch-info">
                                                    <input class="c-switch-input checked_id" type="checkbox" value="{{$course->id}}" name="check"> {{--value="{{$course->id}}" - Для чекбоксов, чтобы работал скрипт JS--}}
                                                    <span class="c-switch-slider"></span>
                                                </label>
                                            </td>
                                            <td width="10%"><img src="{{$course->logo}}" class="img-fluid mx-auto d-block rounded"></td>
                                            <td class="text-center">{{$course->title}}</td>
                                            <td class="text-center">{{mb_substr($course->description, 0, 150, 'UTF-8')}}</td>
                                            <td class="text-right" width="15%">
                                                <a class="btn btn-warning" href="{{route('member_courses', $course->id)}}" style="color: white" title="@lang('courses.button_members')">
                                                    <span class="cil-happy"></span>
                                                </a>
                                                <a class="btn btn-warning" href="{{route('lessons.index', ['course_id' => $course->id])}}" style="color: white" title="@lang('courses.button_lessons')">
                                                    <span class="cil-file"></span>
                                                </a>
                                                <a class="btn btn-info" href="{{route('courses.edit', $course->id)}}" title="@lang('main.button_edit')">
                                                    <span class="cil-pencil"></span>
                                                </a>
                                                {!! Form::open(['route' => ['courses.destroy', $course->id], 'style' => 'display: inline']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
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
                            {{ $courses->links() }} {{--Пагинация--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
