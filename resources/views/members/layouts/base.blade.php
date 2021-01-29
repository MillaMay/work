<!DOCTYPE html>

<html lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/plyr.css">
    <link rel="stylesheet" href="css/free.min.css">
    <title>HR</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body class="main d-flex flex-column">
@include('members.layouts.header')
<div class="content d-flex flex-row">
    @yield('sidebar')
    @yield('content')
</div>


@yield('javascript')
<script src="js/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="js/progres-bar.js"></script>
<script src="js/coreui.bundle.min.js"></script>
<script src="js/index.js"></script>
<script src="js/axios.min.js"></script>
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
<script>
    const player = new Plyr('#player');
</script>
<script>
    if (document.querySelector('[name="editor1"]')) {
        CKEDITOR.replace('editor1');
    }
</script>
</body>
</html>
