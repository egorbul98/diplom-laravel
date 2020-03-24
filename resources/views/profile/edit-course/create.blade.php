@extends('layouts.default')

@section('class-body') edit-course @endsection

@section('content')

<section class="new-course">
  <div class="main-wrap">
    @if ($course->exists)
    <h1 class="new-course__header">Редактирование курса</h1>
    @else
    <h1 class="new-course__header">Создание нового курса</h1>
    @endif
    

    @include('profile.edit-course.parts.form')
    
  </div>
</section>


@endsection
