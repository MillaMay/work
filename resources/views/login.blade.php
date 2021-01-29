<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <title>Login</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="c-app">
                <div class="div-message">
                    @if(session('message.success'))
                        <div class="alert alert-primary">{{ session('message.success') }}</div>
                    @endif
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>

<div class="card no-card">
    <div class="card-header"><strong>@lang('login.title_form')</strong></div>
    <div class="card-body">
        {!! Form::open(['url' => '/authorize', 'method' => 'POST', 'class' => 'form-horizontal']) !!} {{--url - это атрибут action=""--}}
{{--        <form class="form-horizontal" action="{{ route('login') }}" method="post">--}}
            <div class="form-group row">
                {!! Form::label('email', 'Email', ['class' => 'col-md-3 col-form-label']) !!}
{{--                <label class="col-md-3 col-form-label" for="hf-email">Email</label>--}}
                <div class="col-md-9">
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => Lang::get('login.email_placeholder'), 'id' => 'email']) !!}
{{--                    <input class="form-control" id="hf-email" type="email" name="hf-email" placeholder="Email..." autocomplete="email"><br><span class="help-block">Пожалуйста, введите адрес своей почты</span>--}}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('password', Lang::get('login.password'), ['class' => 'col-md-3 col-form-label']) !!}
{{--                <label class="col-md-3 col-form-label" for="hf-password">Пароль</label>--}}
                <div class="col-md-9">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => Lang::get('login.password_placeholder'), 'id' => 'password']) !!}
{{--                    <input class="form-control" id="hf-password" type="password" name="hf-password" placeholder="Пароль..." autocomplete="current-password"><br><span class="help-block">Пожалйста, введите свой пароль</span>--}}
                </div>
            </div>
{{--        </form>--}}
    </div>
    <div class="card-footer">
        {!! Form::submit(Lang::get('login.button_send'), ['class' => 'btn btn-sm btn-info']) !!}
{{--        <button class="btn btn-sm btn-info" type="submit"> Отправить</button>--}}
        {!! Form::reset(Lang::get('login.button_reset'), ['class' => 'btn btn-sm btn-danger']) !!}
{{--        <button class="btn btn-sm btn-danger" type="reset"> Отменить</button>--}}
    </div>
    {!! Form::close() !!}
</div>

</body>
</html>
