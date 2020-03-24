@extends('layouts.default')

@section('class-body') edit-course @endsection

@section('content')

<section class="new-course">
  <div class="main-wrap">
    <h1 class="new-course__header">Создание нового курса</h1>

    @include('profile.edit-course.parts.form')
    
  </div>
</section>


@endsection
