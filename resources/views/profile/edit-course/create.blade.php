@extends('layouts.default')

@section('class-body') edit-course edit-course-description @endsection

@section('content')

<section class="new-course">
  <div class="main-wrap">
    @if ($course->exists)
    <h1 class="new-course__header">@lang('main.course_editing')</h1>
    @else
    <h1 class="new-course__header">@lang('main.creating_a_new_course')</h1>
    @endif
    

    @include('profile.edit-course.parts.form')
    
  </div>
</section>


@endsection
