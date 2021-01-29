@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'tests.update')
            {!! Form::model($test, ['route' => [$route, $test->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($test, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('text-input', Lang::get('tests.title_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => Lang::get('tests.title_placeholder'), 'id' => 'text-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('input-time', Lang::get('tests.time_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::number('time', old('time'), ['class' => 'form-control', 'placeholder' => Lang::get('tests.time_placeholder'), 'id' => 'input-time']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('count_samples', Lang::get('tests.count_samples_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::number('count_samples', old('count_samples'), ['class' => 'form-control', 'placeholder' => Lang::get('tests.count_samples_placeholder'), 'id' => 'count_samples']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('checkpoint', Lang::get('tests.checkpoint_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::number('checkpoint', old('checkpoint'), ['class' => 'form-control', 'placeholder' => Lang::get('tests.checkpoint_placeholder'), 'id' => 'input-time']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('max_point', Lang::get('tests.max_point_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::number('max_point', old('max_point'), ['class' => 'form-control', 'placeholder' => Lang::get('tests.max_point_placeholder'), 'id' => 'input-time']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('select-input', Lang::get('main.select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('lesson_id', $lessons, isset($lesson_id) ? $lesson_id : old('lesson_id'), ['class' => 'form-control', 'placeholder' => Lang::get('tests.select_placeholder'), 'id' => 'select-input']) !!}
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
