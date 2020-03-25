<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>INDEX</title>

</head>

<body class="@yield('class-body')">
   
    @include('parts.notifications')
    
    @include('parts.header')

    @yield('content')
    
    @include('parts.footer')

    <script src="https://kit.fontawesome.com/8dc48f921c.js" crossorigin="anonymous"></script>

    <script src="{{asset("js/index.js")}}"></script>
</body>

</html>
