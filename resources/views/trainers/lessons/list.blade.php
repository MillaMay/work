@extends('trainers.base')
@section('content')
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="float-left"><h5>@lang('lessons.title_table')</h5></div>
                <div class="float-right">
                    @isset($course_id)
                    <a class="btn btn-success" href="{{route('lessons.create', ['course_id' => $course_id])}}" title="@lang('lessons.title_add')">{{--Из-за этого не видит title--}}
                        @else
                    <a class="btn btn-success" href="{{route('lessons.create')}}" title="@lang('lessons.title_add')">{{--вот здесь--}}
                        @endisset
                        <span class="cil-library-add"></span>
                    </a>
                    <form id="form-delete-all" action="{{ route('lessons.destroy', '') }}" class="pull-right" style="display: inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="@lang('lessons.button_delete_all')">
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
                                    <th class="text-center">@lang('lessons.title_lesson')</th>
                                    <th class="text-center">@lang('lessons.description_lesson')</th>
                                    <th class="text-center">@lang('lessons.info_lesson')<br>@lang('lessons.transfer')</th>
                                    <th class="text-center">@lang('lessons.course_lesson')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($lessons as $lesson)
                                        <tr class="odd">
                                            <td>
                                                <label class="c-switch-sm c-switch-info">
                                                    <input class="c-switch-input checked_id" type="checkbox" value="{{$lesson->id}}" name="check">
                                                    <span class="c-switch-slider"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">{{$lesson->title}}</td>
                                            <td class="text-center">{{mb_substr($lesson->description, 0, 150, 'UTF-8')}}</td>
                                            <td class="text-center">
                                                @if($lesson->video)
                                                        <span class="cil-media-play" title="@lang('lessons.video_badge')"></span>
                                                @endif
                                                @if(count($lesson->materials))
                                                        <span class="cil-folder-open" title="@lang('lessons.materials_badge')"></span>
                                                @endif
                                                @if(count($lesson->tests))
                                                    <span class="cil-list" title="@lang('lessons.tests_badge')"></span>
                                                @endif
                                                @if(count($lesson->tasks))
                                                    <span class="cil-description" title="@lang('lessons.task_badge')"></span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $lesson->course->title }}</td>
                                            <td class="text-right"  width="20%">
                                                <a class="btn btn-warning" href="{{route('materials.index', ['lesson_id' => $lesson->id])}}" title="@lang('lessons.icon_materials')"><span class="cil-folder-open"></span></a>
                                                <a class="btn btn-warning" href="{{route('tests.index', ['lesson_id' => $lesson->id])}}" title="@lang('lessons.icon_tests')"><span class="cil-list"></span></a>
                                                <a class="btn btn-warning" href="{{route('tasks.index', ['lesson_id' => $lesson->id])}}" title="@lang('lessons.icon_tasks')"><span class="cil-description"></span></a>
                                                <a class="btn btn-info" href="{{route('lessons.edit', $lesson->id)}}" title="@lang('main.button_edit')">
                                                    <span class="cil-pencil"></span>
                                                </a>
                                                {!! Form::open(['route' => ['lessons.destroy', $lesson->id], 'style' => 'display: inline']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                @isset($course_id)
                                                {!! Form::hidden('course_id', $lesson->course->id) !!}
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
                            {{ $lessons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
