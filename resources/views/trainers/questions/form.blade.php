@extends('trainers.base')
@section('content')
    <div class="card">
        @if($route == 'questions.update')
            {!! Form::model($question, ['route' => [$route, $question->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'update_form']) !!}
            {!! Form::hidden('_method', 'PUT') !!}
        @else
            {!! Form::model($question, ['route' => $route, 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'add_form']) !!}
        @endif
        <div class="card-header"><strong>{{ $title_form }}</strong></div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('select-input', Lang::get('questions.select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('test_id', array_pluck($tests, 'title','id'), isset($test_id) ? $test_id : old('test_id'), ['class' => 'form-control', 'placeholder' => Lang::get('questions.select_placeholder'), 'id' => 'select-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('text-input', Lang::get('questions.title_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => Lang::get('questions.title_placeholder'), 'id' => 'text-input']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('select-input-type', Lang::get('questions.type_select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('type', $types, old('type'), ['class' => 'form-control', 'placeholder' => Lang::get('questions.type_select_placeholder'), 'id' => 'select-input-type']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('point', Lang::get('questions.point_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::number('point', old('point'), ['class' => 'form-control', 'placeholder' => Lang::get('questions.point_placeholder'), 'id' => 'point']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('point_accrual', Lang::get('questions.point_accrual_select_field'), ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('point_accrual', $point_accruals, old('point_accrual'), ['class' => 'form-control', 'placeholder' => Lang::get('questions.point_accrual_select_placeholder'), 'id' => 'point_accrual']) !!}
                </div>
            </div>

{{--Код checkbox для баллов--}}
            {{--<div class="form-group row">--}}
                {{--<div class="col-md-2">--}}
                    {{--Выберите тип начисления баллов--}}
                {{--</div>--}}
                {{--<div class="col-md-10">--}}
                    {{--<label class="c-switch-sm c-switch-info" title="Баллы вопроса" id="label_point">--}}
                        {{--<input class="c-switch-input" type="checkbox" name="" value="" onclick="showMe(this)">--}}
                        {{--<span class="c-switch-slider"></span>--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group row">--}}
                {{--<label class="col-md-2 col-form-label" for="input_point">Количество баллов</label>--}}
                {{--<div class="col-md-10" id="point_question" style="display:block;">--}}
                    {{--<input name="point" class="form-control" type="number" placeholder="Введите число баллов для вопроса">--}}
                {{--</div>--}}
                {{--<div class="col-md-10" id="point_answer" style="display:none;">--}}
                    {{--<input name="point" class="form-control" type="number" placeholder="Введите число баллов для ответа">--}}
                {{--</div>--}}
            {{--</div>--}}
{{--Конец кода--}}

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered" style="border-collapse: collapse !important" id="answer_table">
                        <thead>
                        <tr>
                            <th class="text-center">@lang('questions.title_answer')</th>
                            <th class="text-center">@lang('questions.point_answer')</th>
                            <th class="text-center">@lang('questions.correctly')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--Если ответов 0, то ошибку не выдаст, потому что в контроллере прописано условие на существование ответа для вопроса--}}
                            @if(isset($answers) and isset($question->id))
                                @foreach($answers as $answer)
                                    <tr class="odd">
                                        <td class="text-center">
                                            <div class="col-md-12">
                                                {!! Form::text('answers[' . $loop->index . '][title]', old('title', $answer->title), ['class' => 'form-control', 'placeholder' => Lang::get('questions.answer_title_placeholder')]) !!}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="col-md-12">
                                                {!! Form::number('answers[' . $loop->index . '][point]', old('point', $answer->point), ['class' => 'form-control', 'placeholder' => Lang::get('questions.answer_point_placeholder')]) !!}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="col-md-12">
                                                <input class="c-switch-input" type="hidden" name="answers[{{$loop->index }}][correctly]" value="0">
                                                <label class="c-switch-sm c-switch-info"  title="{{($answer->correctly == 1) ? Lang::get('questions.checked_answer') : Lang::get('questions.not_checked_answer')}}">
                                                    <input class="c-switch-input" type="checkbox" {{($answer->correctly == 1) ? 'checked' : ''}} name="answers[{{$loop->index }}][correctly]" value="{{('checked') ? 1 : 0}}"><span class="c-switch-slider"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn btn-danger cil-minus remove_answer" title="@lang('questions.button_minus')"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        <tfoot>
                        <tr class="odd" style="background: #ebedef">
                            <td colspan="3"></td>
                            <td class="text-right">
                                <div id="add_answer" class="btn btn-success cil-plus" title="@lang('questions.button_plus')"></div>
                            </td>
                        </tr>
                        </tfoot>
                        </tbody>
                    </table>
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
