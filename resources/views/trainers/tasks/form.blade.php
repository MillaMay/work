@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'tasks.update')
            {!! Form::model($task, ['route' => [$route, $task->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($task, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('textarea-input', Lang::get('tasks.description_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => Lang::get('tasks.description_placeholder'), 'id' => 'textarea-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('input-max_point', Lang::get('tasks.max_point_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::number('max_point', old('max_point'), ['class' => 'form-control', 'placeholder' => Lang::get('tasks.max_point_placeholder'), 'id' => 'input-max_point']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('select-input', Lang::get('main.select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('lesson_id', $lessons, isset($lesson_id) ? $lesson_id : old('lesson_id'), ['class' => 'form-control', 'placeholder' => Lang::get('tasks.select_placeholder'), 'id' => 'select-input']) !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit($title_button, ['class' => 'btn btn-sm btn-info']) !!}
            {!! Form::reset(Lang::get('main.cancel'), ['class' => 'btn btn-sm btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
