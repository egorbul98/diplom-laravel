@extends('layouts.default')

@section('class-body') profile @endsection

@section('content')

@include('profile.parts.profile-header')

<div class="main-wrap">
  <section class="profile-wrapper">
    
    @include('profile.parts.sidebar')

    <main class="profile-content">
   
        <h3 class="title">Ваши созданные тесты</h3>
        <a href="{{route("profile.tests.create")}}" class="btn btn-add"><span class="icon"><i class="fas fa-plus"></i></span> Создать</a>
      
      <div class="test-list">

        @for ($i = 0; $i < 6; $i++) 
        <div class="test-item shadow-light">
            <div class="test-item-inner">
                <div class="left">
                    <div class="test-item__title">Тест номер один</div>
                </div>
                <div class="icon-arrow"><i class="fas fa-chevron-left"></i></div>
            </div>
            <div class="test-item-models">
              <div class="test-item-models__item">
                <h4 class="test-item-models__text">
                  Модули, к которым прикреплен данный тест
                </h4>
                <button class="btn" type="button">Прикрепить тест к модулю</button>
              </div>
                <div class="test-item-models__inner">
                  <div class="test-item-models__item">
                    <p class="test-item-models__text">
                      <a href="#">Умение считать просыте интегралы</a>
                    </p>
                    <button class="btn" type="button">Открепить</button>
                  </div>
                </div>
               
            </div>
        </div>
        @endfor 
    </div>

    </main>
  </section>
</div>




@endsection
