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

<body class="@yield('class-body') editor">
   <div class="main-wrap">
        <div class="notifications ">
            @if (session("success"))
            <div class="notifications__item notifications__item--success"><span class="text">{{session("success")}}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="notifications__item notifications__item--error"><span class="text">{{$error}}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
                @endforeach
            @endif
           
        </div>
   </div>
   
    

    @include('parts.header')

    @yield('content')
    
    @include('parts.profile.footer-editor')

    <script src="https://kit.fontawesome.com/8dc48f921c.js" crossorigin="anonymous"></script>

    <script src="{{asset("js/index.js")}}"></script>
</body>

</html>
