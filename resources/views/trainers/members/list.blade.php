@extends('trainers.base')
@section('content')
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="float-left"><h5>@lang('members.title_table')</h5></div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{route('members.create')}}" title="@lang('members.title_add')">
                        <span class="cil-library-add"></span>
                    </a>
                    <form id="form-delete-all" action="{{ route('members.destroy', '') }}" class="pull-right" style="display: inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="@lang('members.button_delete_all')">
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
                                    <th class="text-center">@lang('members.name_member')</th>
                                    <th class="text-center">@lang('members.avatar_member')</th>
                                    <th class="text-center">@lang('members.email_member')</th>
                                    <th class="text-center">@lang('members.phone_member')</th>
                                    <th class="text-center">@lang('members.city_member')</th>
                                    <th class="text-center">@lang('members.store_member')</th>
                                    <th class="text-center">@lang('members.post_member')</th>
                                    <th class="text-center">@lang('members.type_member')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr class="odd">
                                            <td>
                                                <label class="c-switch-sm c-switch-info">
                                                    <input class="c-switch-input checked_id" type="checkbox" value="{{$member->id}}" name="check">
                                                    <span class="c-switch-slider"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">{{$member->name}}</td>
                                            <td width="10%"><img src="{{$member->avatar}}" class="img-fluid mx-auto d-block rounded"></td>
                                            <td class="text-center">{{$member->email}}</td>
                                            <td class="text-center">{{$member->phone}}</td>
                                            <td class="text-center">{{$member->city}}</td>
                                            <td class="text-center">{{$member->store}}</td>
                                            <td class="text-center">{{$member->post}}</td>
                                            <td class="text-center">
                                                @if($member->type == 0)
                                                    @lang('members.type_intern')
                                                @else
                                                    @lang('members.type_consultant')
                                                @endif
                                            </td>
                                            <td class="text-right" width="10%">
                                                <a class="btn btn-info" href="{{route('members.edit', $member->id)}}" title="@lang('main.button_edit')">
                                                    <span class="cil-pencil"></span>
                                                </a>
                                                {!! Form::open(['route' => ['members.destroy', $member->id], 'style' => 'display: inline']) !!}
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
                            {{ $members->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
