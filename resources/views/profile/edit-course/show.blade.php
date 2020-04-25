@extends('layouts.default')

@section('class-body') profile @endsection

@section('content')

@include('profile.edit-course.parts.course-header')

<div class="main-wrap">
  <div class="flex-b flex-wrap">
    <h1 class="title">@lang('main.sections')</h1>
    <a href="{{route("profile.course.sections.edit", $course)}}" class="btn flex-c">@lang('main.edit_sections')</a>
  </div>
  @include('profile.edit-course.parts.course-sections', $course)
</div>



@endsection
