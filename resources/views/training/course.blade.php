@extends('layouts.training-layout') 
@section('class-body') @endsection


@section('content')
    
<div class="lesson-content__header">
  <h1 class="title">{{$course->title}}</h1>
  <p class="desc">{{$course->description}}</p>
</div>
<br>

<h2 class="title necessary">Вам необходимо</h2>
<div class="lesson-content-wrapper">

  <div class="lesson-content__tests">
    <h2 class="title">Пройти тест</h2>
    <div class="test shadow-light">
      <h3 class="title">Тест включает вопросы из следующих модулей</h3>
      <div class="test__list-modules">
        <div class="test__module">
          <p class="name">Сетевые технологии</p>
          <div class="section">Раздел 1</div>
        </div>
        <div class="test__module">
          <p class="name">Lorem, ipsum dolor.</p>
          <div class="section">Раздел 1</div>
        </div>
        <div class="test__module">
          <p class="name">Lorem ipsum dolor sit.</p>
          <div class="section">Раздел 2</div>
        </div>
      </div>
      <a href="lesson-page-module-test.html" class="test__link"></a>
    </div>
    
  </div>

  <div class="lesson-content__module-wrap">
    <h2 class="title">Повторить модуль</h2>
    <div class="module shadow-light">
      <div class="module-list-steps">
        <p class="module-list-steps__item">3 шага</p>
        <p class="module-list-steps__item">2 задачи</p>
      </div>
      <div class="module-inner">
        <div class="left">
          <h2 class="module__title">Сетевые технологии</h2>
          <div class="progress-line">
            <div class="progress-line__fill"></div>
          </div>
        </div>
        <div class="right">
          <p class="">После освоения модуля вы получите:</p>
          <div class="competencies">
            <p class="competencie">Знание что такое классификация</p>
            <p class="competencie">Умение классифицировать штуки</p>
          </div>
        </div>
      </div>
      <a href="lesson-page-module.html" class="module__link"></a>
    </div>
  </div>
</div>

@endsection