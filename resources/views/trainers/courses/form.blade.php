@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'courses.update')
            {!! Form::model($course, ['route' => [$route, $course->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($course, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
    {{--        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">--}}
                <div class="form-group row">
                    {!! Form::label('text-input', Lang::get('courses.title_field'), ['class' => 'col-md-2 col-form-label']) !!}
    {{--                <label class="col-md-2 col-form-label" for="text-input">@lang('courses.title_field')</label>--}}
                    <div class="col-md-10">
                        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => Lang::get('courses.title_placeholder'), 'id' => 'text-input']) !!}
    {{--                    <input class="form-control" id="text-input" type="text" name="text-input" placeholder="@lang('courses.title_placeholder')">--}}
    {{--                    Функция old() сохраняет данные в инпуте--}}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('textarea-input', Lang::get('courses.description_field'), ['class' => 'col-md-2 col-form-label']) !!}
    {{--                <label class="col-md-2 col-form-label" for="textarea-input">@lang('courses.description_field')</label>--}}
                    <div class="col-md-10">
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => Lang::get('courses.description_placeholder'), 'id' => 'textarea-input']) !!}
    {{--                    <textarea class="form-control" id="textarea-input" name="textarea-input" rows="9" placeholder="@lang('courses.description_placeholder')"></textarea>--}}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('thumbnail', Lang::get('courses.file_logo'), ['class' => 'col-md-2 col-form-label']) !!}
    {{--                <label class="col-md-2 col-form-label" for="file-input">@lang('courses.file_logo')</label>--}}
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success text-white">
                                    <i class="fa fa-picture-o"></i> @lang('courses.upload_image')
                                </a>
                            </span>
                            {!! Form::text('logo', old('logo'), ['class' => 'form-control', 'style' => 'border-radius: 0.25rem', 'id' => 'thumbnail']) !!}
    {{--                        <input id="thumbnail" class="form-control" type="text" name="logo" style="border-radius: 0.25rem">--}}
                        </div>
                        <div id="holder" style="margin-top:15px; max-height:100px;"><img class="rounded" width="100" src="{{ old('logo') ? old('logo') : $course->logo }}"></div> {{-- Добавлен тег img, при редактировании также была видна картинка --}}
                    </div>
                </div>
{{--            {!! Form::hidden('trainer_id', '1') !!} --}} {{--Передан пока trainer_id = 1 --}} 
    {{--        </form>--}}
        </div>
            <div class="card-footer">
                {!! Form::submit($title_button, ['class' => 'btn btn-sm btn-info']) !!}
        {{--        <button class="btn btn-sm btn-primary" type="submit" form="add_form">@lang('courses.add_form')</button>--}}
                {!! Form::reset(Lang::get('main.cancel'), ['class' => 'btn btn-sm btn-danger']) !!}
        {{--        <button class="btn btn-sm btn-danger" type="reset" form="add_form">@lang('courses.cancel_form')</button>--}}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
