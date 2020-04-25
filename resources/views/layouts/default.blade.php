<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>@lang('main.online_courses')</title>
    {{-- <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>  --}}

</head>

<body class="@yield('class-body')">
    @include('parts.notifications')
    <main class="main-container">
        <div>
            @include('parts.header')

            @yield('content')
        </div>


        @include('parts.footer')
    </main>
    {{-- <script src="https://kit.fontawesome.com/8dc48f921c.js" crossorigin="anonymous"></script> --}}

    <script src="{{asset("js/index.js")}}"></script>
</body>

</html>
