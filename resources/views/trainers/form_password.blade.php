@extends('trainers.base')
@section('content')
    <div class="card">
        {!! Form::model($trainer, ['route' => [$route, $trainer->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form', 'method' => 'POST']) !!}
        <div class="card-header"><strong>@lang('trainers.title_form')</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('password', Lang::get('trainers.password_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => Lang::get('trainers.password_placeholder'), 'id' => 'password']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('password-new', Lang::get('trainers.password1_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => Lang::get('trainers.password1_placeholder'), 'id' => 'password-new']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('password-new-replay', Lang::get('trainers.password2_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::password('new_replay_password', ['class' => 'form-control', 'placeholder' => Lang::get('trainers.password2_placeholder'), 'id' => 'password-new-replay']) !!}
                </div>
            </div>
        </div>
            <div class="card-footer">
                {!! Form::submit(Lang::get('main.save'), ['class' => 'btn btn-sm btn-info']) !!}
                {!! Form::reset(Lang::get('main.cancel'), ['class' => 'btn btn-sm btn-danger']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
