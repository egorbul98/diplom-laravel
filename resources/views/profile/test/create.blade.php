@extends('layouts.default')

@section('class-body') edit-course @endsection

@section('content')

<section class="new-course">
  <div class="main-wrap">
    @if ($test->exists)
    <h1 class="new-course__header">Редактирование теста</h1>
    @else
    <h1 class="new-course__header">Создание нового теста</h1>
    @endif
    

    @if ($test->exists)
        <form class="form" action="{{route("profile.course.update", $test->id)}}" method="POST">
        @method("PUT")
      @else
      <form class="form" action="{{route("profile.course.store")}}" method="POST">
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
            <p><label class="" for="content">Описание теста</label></p>
          </div>
          <div class="form-row__right form-field">
            <textarea name="content" id="content" rows="10">{{old("content", $test->description)}}</textarea>
          </div>
        </div>

        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="edit-foto">Изображение</label></p>
          </div>
          <div class="form-row__right form-field">
            <div class="new-course__img">
              <img src="img/course.jpg" alt=""><span class="icon"><i class="fas fa-camera"></i></span>
              <input type="file" id="image" name="image" style="visibility: hidden;">
              <label for="image" class="edit-foto"><i class="fas fa-edit"></i></label>
            </div>
      
          </div>
        </div>
        
        <div class="form-btns-wrap">
          @if ($test->exists)
            <button class="btn" type="submit"><span class="icon m-r-8"><i class="fas fa-save"></i></span> Сохранить</button>
          @else
            <button class="btn" type="submit">Создать</button>
          @endif
          
          <a href="{{URL::previous()}}" class="btn">Отмена</a>
        </div>

      </form>
    
  </div>
</section>


@endsection
