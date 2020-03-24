@extends('layouts.default')

@section('class-body') profile @endsection

@section('content')

@include('profile.edit-course.parts.course-header')

<div class="main-wrap">
  <div class="flex-b">
    <h1 class="title">Разделы</h1>
  <a href="{{route("profile.course.sections.edit", $course)}}" class="btn flex-c">Редактировать разделы</a>
  </div>
  @include('profile.edit-course.parts.course-sections', $course)

</div>

@endsection
