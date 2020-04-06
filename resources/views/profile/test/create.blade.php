{{-- @extends('layouts.default') --}}
@extends('layouts.profile-editor')

@section('class-body') edit-test @endsection

@section('content')

<section class="new-test">
  <div class="main-wrap">
    @if ($test->exists)
    <h1 class="new-course__header">Редактирование теста</h1>
    @else
    <h1 class="new-course__header">Создание нового теста</h1>
    @endif
    
    @if ($test->exists)
        <form class="form" action="{{route("profile.test.update", $test)}}" method="POST">
          @method("PUT")
    @else
      <form class="form" action="{{route("profile.test.store")}}" method="POST">
    @endif
        @csrf
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="title">Название<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <input class="input-control" maxlength="64" id="title" name="title" type="text" value="{{old("title", $test->title)}}">
            <div class="form-field__tooltip">
              <span class="text">Не более 64 символов</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="description">Описание теста</label></p>
          </div>
          <div class="form-row__right form-field">
            <textarea name="description" id="description" rows="10">{{old("content", $test->description)}}</textarea>
          </div>
        </div>

        <div class="form-btns-wrap">
          @if ($test->exists)
            <button class="btn" type="submit"><span class="icon m-r-8"><i class="fas fa-save"></i></span> Сохранить</button>
            {{-- <a href="{{route("profile.test.show", [$test, 2])}}" class="btn">К редактированию вопросов</a> --}}
          @else
            <button class="btn" type="submit">Создать</button>
          @endif
          
            <a href="{{route("profile.test.index")}}" class="btn">К списку тестов</a>
        </div>

      </form>
    
  </div>
</section>
@if ($test->exists)

<section class="test-sections margin-bottom-100" data-test-id="{{$test->id}}">
  <div class="main-wrap">
    <h2 class="new-course__header">Вопросы и варианты ответов</h2>

   
      <div class="test-sections-links">
    
        @for ($i = 0; $i < count($test->test_sections); $i++)
          <div class="test-sections-links__item" >
            <a href="{{$test->test_sections[$i]->id}}" class="test-sections-links__item-link" data-test-section-id="{{$test->test_sections[$i]->id}}">{{($i + 1)}}</a>
          </div>
        @endfor

      </div>
      
      <div class="test-sections-content">
      <div class="margin-bottom-20">
        <h4 class="title">Текст вопроса</h4>
        <div class="form-field">
          <input type="text" class="input-control" id="test-section-title" name="title" value="" maxlength="400" placeholder="Введите текст вопроса?">
        </div>
      </div>
      <h4 class="title">Добавить картинку</h4>
      <div class="flex-b">
        <div class="test-sections__img">
          <img src="" alt="">
        </div>
        <div class="form-field">
          <input type="file" class="" name="image" value="" maxlength="400" placeholder="Введите текст вопроса?">
        </div>
      </div>
  
      <div class="answers-list">
        <p>Верный</p>
        <div class="answers-list-inner">
          
          <div class="answer" >
            <div class="answer-inner">
              <div class="check"><input type="checkbox" name="checkbox" value=""></div>
              <input type="text" name="text" value="" class="input-control text">
            </div>
            <div class="answer-icon-wrap">
              <div class="icon icon--delete"><i class="fas fa-times"></i></div>
              <div class="icon icon--add"><i class="fas fa-plus"></i></div>
            </div>
          </div>
          
        
          
        </div>
      </div>
  
      <div class="form-btns-wrap">
        <button class="btn btn-save-test-section" type="button"><i class="fas fa-save"></i> Сохранить вопрос</button>
        <button class="btn btn-del-test-section" type="button">Удалить вопрос</button>
        <button class="btn btn-add-test-section" type="button" data-test-section-id="">Добавить следующий вопрос</button>
      </div>
    </div>
  </div>
</section>

@endif

@endsection
