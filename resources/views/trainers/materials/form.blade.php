@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'materials.update')
            {!! Form::model($material, ['route' => [$route, $material->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($material, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('text-input', Lang::get('materials.title_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => Lang::get('materials.title_placeholder'), 'id' => 'text-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('textarea-input', Lang::get('materials.description_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => Lang::get('materials.description_placeholder'), 'id' => 'textarea-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('text-input-url', Lang::get('materials.url_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('URL', old('URL'), ['class' => 'form-control', 'placeholder' => Lang::get('materials.url_placeholder'), 'id' => 'text-input-url']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('select-input', Lang::get('main.select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('lesson_id', $lessons, isset($lesson_id) ? $lesson_id : old('lesson_id'), ['class' => 'form-control', 'placeholder' => Lang::get('materials.select_placeholder'), 'id' => 'select-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('thumbnail', Lang::get('materials.file_image'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success text-white">
                                    <i class="fa fa-picture-o"></i> @lang('materials.upload_image')
                                </a>
                            </span>
                        {!! Form::text('image', old('image'), ['class' => 'form-control', 'style' => 'border-radius: 0.25rem', 'id' => 'thumbnail']) !!}
                    </div>
                    <div id="holder" style="margin-top:15px; max-height:100px;"><img class="rounded" width="100" src="{{ old('image') ? old('image') : $material->image }}"></div>
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
