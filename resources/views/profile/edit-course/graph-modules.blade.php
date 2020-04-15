@extends('layouts.default')

@section('class-body') profile graph-modules @endsection

@section('content')

@include('profile.edit-course.parts.course-header')

<div class="main-wrap">
  <div class="flex-b flex-wrap">
    <h1 class="title">Деревья модулей</h1>
    <a href="{{route("profile.course.sections.edit", $course)}}" class="btn flex-c">Редактировать разделы</a>
  </div>


<div class="graphs-list">
  @foreach ($course->sections as $section)
  <div class="graphs-list-item">
    <h3 class="title">{{$section->title}}</h3>
    <div id="graph{{$section->id}}" class="graph-block"></div>
  </div>
  
  @endforeach
</div>
  
 

</div>



@endsection
