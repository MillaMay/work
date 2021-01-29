@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'members.update')
            {!! Form::model($member, ['route' => [$route, $member->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($member, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
            <div class="card-body">
                <div class="form-group row">
                    {!! Form::label('text-input', Lang::get('members.name_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => Lang::get('members.name_placeholder'), 'id' => 'text-input']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('email-input', Lang::get('members.email_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => Lang::get('members.email_placeholder'), 'id' => 'email-input']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('phone', Lang::get('members.phone_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'id' => 'phone']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('input-city', Lang::get('members.city_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => Lang::get('members.city_placeholder'), 'id' => 'input-city']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('input-store', Lang::get('members.store_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('store', old('store'), ['class' => 'form-control', 'placeholder' => Lang::get('members.store_placeholder'), 'id' => 'input-store']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('input-post', Lang::get('members.post_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('post', old('post'), ['class' => 'form-control', 'placeholder' => Lang::get('members.post_placeholder'), 'id' => 'input-post']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('select-input-type', Lang::get('members.type_select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::select('type', $types, old('type'), ['class' => 'form-control', 'placeholder' => Lang::get('members.type_select_placeholder'), 'id' => 'select-input-type']) !!}
                    </div>
                </div>
                <div class="form-group row"> {{--avatar--}}
                    {!! Form::label('thumbnail', Lang::get('members.file_avatar'), ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success text-white">
                                    <i class="fa fa-picture-o"></i> @lang('members.upload_avatar')
                                </a>
                            </span>
                            {!! Form::text('avatar', old('avatar'), ['class' => 'form-control', 'style' => 'border-radius: 0.25rem', 'id' => 'thumbnail']) !!}
                        </div>
                        <div id="holder" style="margin-top:15px; max-height:100px;"><img class="rounded" width="100" src="{{ old('avatar') ? old('avatar') : $member->avatar }}"></div>
                    </div>
                </div>
                {!! Form::hidden('password', md5('kek')) !!} {{--str_random(10) вместо 'kek'--}}
            </div>
            <div class="card-footer">
                {!! Form::submit($title_button, ['class' => 'btn btn-sm btn-info']) !!}
                {!! Form::reset(Lang::get('main.cancel'), ['class' => 'btn btn-sm btn-danger']) !!}
            </div>
            {!! Form::close() !!}
    </div>

{{--Для инпута телефона--}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
<script>
    $("#phone").mask("+38 (999) 999 - 99 - 99");
</script>

{{--{!!--}} {{--Функция, очищающая от всего, кроме цифр--}}
{{-- $str = '+38 (066) 828 - 74 - 77';--}}
{{-- $str2 = preg_replace('/[^0-9]/', '', $str);--}}
{{-- dd($str2);--}}
{{--!!}--}}

@endsection
