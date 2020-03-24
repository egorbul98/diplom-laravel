@extends('layouts.profile-editor')

@section('class-body') edit-course @endsection

@section('content')

@include('profile.edit-course.parts.course-header')

<div class="main-wrap margin-bottom-100">
  <div class="flex-b">
    <h1 class="title">Разделы</h1>
  </div>

  <section class="course-sections">
    <form action="" class="form">
      <div class="course-sections-list">
        @foreach ($course->sections as $section)
            @include('profile.edit-sections.parts.course-sections-item', $section)
        @endforeach
        
      </div>
      <button type="button" id="btn-create-section" class="btn">Создать раздел</button>
    </form>
    
  </section>

</div>

@endsection
