@extends('trainers.base')
@section('content')
    <div class="card">
        {!! Form::model($trainer, ['route' => [$route, $trainer->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
        {!! Form::hidden('_method', 'PUT') !!}
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('text', Lang::get('trainers.name_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => Lang::get('trainers.name_placeholder'), 'id' => 'text']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email', Lang::get('trainers.email_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('phone', Lang::get('trainers.phone_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'id' => 'phone']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('department', Lang::get('trainers.department_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('department', old('department'), ['class' => 'form-control', 'placeholder' => Lang::get('trainers.department_placeholder'), 'id' => 'department']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('thumbnail', Lang::get('trainers.file_avatar'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success text-white">
                                <i class="fa fa-picture-o"></i> @lang('trainers.upload_avatar')
                            </a>
                        </span>
                        {!! Form::text('avatar', old('avatar'), ['class' => 'form-control', 'style' => 'border-radius: 0.25rem', 'id' => 'thumbnail']) !!}
                    </div>
                    <div id="holder" style="margin-top:15px; max-height:100px;"><img class="rounded" width="100" src="{{ old('avatar') ? old('avatar') : $trainer->avatar }}"></div>
                </div>
            </div>
            <div class="text-right">
                <a class="btn btn-warning text-white" href="{{route('password', $trainer->id)}}">@lang('trainers.button_password')</a>
            </div>
        </div>
            <div class="card-footer">
                {!! Form::submit($title_button, ['class' => 'btn btn-sm btn-info']) !!}
                {!! Form::reset(Lang::get('main.cancel'), ['class' => 'btn btn-sm btn-danger']) !!}
            </div>
        {!! Form::close() !!}
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/js/jquery.maskedinput-master/dist/jquery.maskedinput.js" type="text/javascript"></script>
<script>
    $("#phone").mask("+38 (999) 999 - 99 - 99");
</script>

@endsection
