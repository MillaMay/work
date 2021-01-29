@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'lessons.update')
            {!! Form::model($lesson, ['route' => [$route, $lesson->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($lesson, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('text-input', Lang::get('lessons.title_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => Lang::get('lessons.title_placeholder'), 'id' => 'text-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('textarea-input', Lang::get('lessons.description_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => Lang::get('lessons.description_placeholder'), 'id' => 'textarea-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('select-input', Lang::get('lessons.select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('course_id', array_pluck($courses, 'title', 'id'), isset($course_id) ? $course_id : old('course_id'), ['class' => 'form-control', 'placeholder' => Lang::get('lessons.select_placeholder'), 'id' => 'select-input']) !!}
{{--                    <select class="form-control" id="select-input" name="course_id">--}}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('thumbnail', Lang::get('lessons.file_video'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success text-white">
                                <i class="fa fa-picture-o"></i> @lang('lessons.upload_video')
                            </a>
                        </span>
                        {!! Form::text('video', old('video'), ['class' => 'form-control', 'style' => 'border-radius: 0.25rem', 'id' => 'thumbnail']) !!}
                    </div>
                    <div id="holder" style="margin-top:15px; max-height:100px;"><img class="rounded" width="100" src="{{ old('video') ? old('video') : $lesson->video }}"></div>
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
