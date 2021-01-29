<!DOCTYPE html>

<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0-alpha.1
* @link https://coreui.io
* Copyright (c) 2019 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">{{--{{App::setLocale('es')}}--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HR</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/a4a601cc1920531db6f9e7dcb8783803.ico"> {{--Скаченная мной иконка--}}
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet">

@yield('css')

    {{--<link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">--}}
</head>

<body class="c-app">

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    @include('trainers.layouts.left_sidebar')
</div>

<div class="c-wrapper">
    @include('trainers.layouts.header')

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
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

                @yield('content')

            </div>
        </main>
    </div>
</div>
{{--    @include('dashboard.shared.footer')--}}

<!-- CoreUI and necessary plugins-->
<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>

<!--Standalone Image Button-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> {{--Подключение jQuery--}}

<script>
    var route_prefix = "/filemanager";
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: route_prefix});
</script>

@yield('javascript')

</body>
</html>
