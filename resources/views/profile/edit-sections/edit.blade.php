@extends('layouts.profile-editor')

@section('class-body') edit-course @endsection

@section('content')

@include('profile.edit-course.parts.course-header')
<div class="tabs-container">
<div class="main-wrap margin-bottom-100">
  <div class="flex-b ">
    <h1 class="title">Разделы</h1>
    @include('parts.tabs-btns')
  </div>

<section class="course-sections" data-course-id="{{$course->id}}">
    <form action="{{route("profile.course.sections.save", $course->id)}}" class="form" id="form-save-sections" method="POST">
      @csrf
      <div class="course-sections-list" data-author-id="{{$user->id}}">
        @php  $i = 0  @endphp
        @foreach ($course->sections as $section)
            @php  $i++  @endphp
            @include('profile.edit-sections.parts.course-sections-item', $section)
        @endforeach
        
      </div>
    </form>
      <div class="form">
        <div class="course-sections-item ">
          <div class="course-sections-item__inner section-edit shadow-light">
            <div class="section-edit-wrap">
              <div class="section-edit-wrap__inputs">
                <div class="form-row">
                  <div class="form-row__left">
                    <p><label class="" for="title">Название<span class="required-input">*</span></label></p>
                  </div>
                  <div class="form-row__right form-field">
                    <input class="input-control" maxlength="64" id="title" type="text">
                    <div class="form-field__tooltip">
                      <span class="text">Не более 128 символов</span>
                    </div>
                  </div>
                </div>
        
                <div class="form-row">
                  <div class="form-row__left">
                    <p><label class="" for="title">Описание<span class="required-input">*</span></p>
                  </div>
                  <div class="form-row__right form-field">
                    <textarea name="" cols="30" rows="5" id="description"></textarea>
                    <div class="form-field__tooltip">
                      <span class="text">Не менее 10 символов</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <button type="button" id="btn-create-section" data-id-course="{{$course->id}}" class="btn">Создать раздел</button>
          </div>
          
        </div>
      </div>
    
  </section>

  <div class="modal modal--hidden modal-modules">
    <div class="modal-window">
        <div class="modal-inner">
          <h2 class="title center">Выберите модуль для добавления в раздел</h2>
          <div class="form-field">
            <input type="text" class="search" placeholder="Найти модуль по названию">
            <button class="btn btn-search" type="submit">Искать</button>
          </div>

          <div class="modal-list-modules">
            <p>Модулей пока нет</p>
          </div>

          <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
        </div>
    </div>
  </div>

</div>
</div>
@include('profile.parts.footer-editor', [$body = "sections"])
@endsection
