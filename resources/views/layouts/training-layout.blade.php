<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>Обучение</title>

</head>

<body class="lesson-page @yield('class-body')">
   
    @include('parts.notifications')
    
    @include('training.parts.header-training')

   
    
    <div class="wrapper">
        @include('training.parts.lesson-sidebar')
    
        <main class="lesson-content"> @yield('content') </main>
    
    </div>

    <script src="{{asset("js/index.js")}}"></script>
</body>

</html>


