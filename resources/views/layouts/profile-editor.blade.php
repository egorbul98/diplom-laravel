<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>@lang('main.personal_area')</title>

</head>

<body class="@yield('class-body') editor">
    
    @include('parts.notifications')
   
    @include('parts.header')
@auth
    @yield('content')
        
    
@else
<h1 class="no-entry"><a href="{{route("login")}}">Необходимо авторизоваться</a></h1>
@endauth
    

   
    <script src="{{asset("js/index.js")}}"></script>
</body>

</html>
