@extends('layouts.training-layout')
@section('class-body') learning-path @endsection


@section('content')

<div class="lesson-content__header">
    <h1 class="title">{{$course->__("title")}}</h1>
    <p class="desc">@lang('main.your_learning_path')</p>
</div>
<br>

<div class="learning-path__graphs-list">
    {{-- <div id="graph" class="learning-path__graph" data-course-id="{{$course->id}}"></div> --}}
    <div id="learning-path__graph-full" class="learning-path__graph-full" data-course-id="{{$course->id}}"></div>
</div>

@endsection
