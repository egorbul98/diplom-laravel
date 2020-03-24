{{-- @extends('layouts.app') --}}
@extends('layouts.default')

@section('class-body') @endsection

@section('content')

<section class="recommend-outer shadow">
    <div class="recommend">
        <div class="main-wrap">
            <div class="recommend-wrap">
                <h2 class="title">Рекомендуем к изучению</h2>
                <div class="recommend-list">
                    @foreach ($courses as $course)
                        @include('parts.recomend-item', $course)
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</section>

<section class="title-outer">
    <h1 class="title">Новые курсы</h1>
    <div class="line"></div>
</section>

<section class="courses">
    <div class="main-wrap">
        <div class="courses-list">
            @foreach ($courses as $course)
                @include('parts.course-item', $course)
            @endforeach
        </div>
        <a href="#" class="btn btn-more">Показать еще</a>
</section>

<section class="title-outer">
    <h1 class="title">Популярные курсы</h1>
    <div class="line"></div>
</section>

<section class="courses">
    <div class="main-wrap">
        <div class="courses-list">
            @for ($i = 0; $i < 6; $i++) @include('parts.course-item') @endfor 
        </div>
        <a href="#" class="btn btn-more">Показать еще</a>
    </div>
</section>

<section class="title-outer">
    <h1 class="title">Новости и статьи</h1>
    <div class="line"></div>
</section>

<section class="news">
    <div class="main-wrap">
        <div class="news-list">

            <div class="news-item">
                <div class="news-item__img">
                    <img src="{{asset("img/course.jpg")}}" alt="картинка курса">
                </div>
                <div class="news-item__info">
                    <h3 class="news-item__title">
                        Полное руководство по Python 3: от новичка до специалиста
                        Полное руководство по Python 3: от новичка до специалиста
                        Полное руководство по Python 3: от новичка до специалиста
                    </h3>

                    <div class="news-item__time">
                        <span class="icon"><i class="fas fa-clock"></i></span><span class="time">17.03.2020</span>
                    </div>
                </div>
                <div class="news-item__ellipse"></div>
                <div class="news-item__overlay">
                    <h1>Открыть</h1>
                </div>
            </div>
            <div class="news-item">
                <div class="news-item__img">
                    <img src="img/course.jpg" alt="картинка курса">
                </div>
                <div class="news-item__info">
                    <h3 class="news-item__title">
                        Полное руководство по Python 3: от новичка до специалиста
                        Полное руководство по Python 3: от новичка до специалиста
                        Полное руководство по Python 3: от новичка до специалиста
                    </h3>

                    <div class="news-item__time">
                        <span class="icon"><i class="fas fa-clock"></i></span><span class="time">17.03.2020</span>
                    </div>
                </div>
                <div class="news-item__ellipse"></div>
                <div class="news-item__overlay">
                    <h1>Открыть</h1>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-more">Показать еще</a>
    </div>
</section>
@endsection
{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
</div>
@endif

You are logged in!
</div>
</div>
</div>
</div>
</div>
@endsection --}}
