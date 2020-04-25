@extends('layouts.default')

@section('class-body') profile @endsection

@section('content')

@include('profile.parts.profile-header')

<div class="main-wrap">
  <section class="profile-wrapper">
    
    @include('profile.parts.sidebar')

    <main class="profile-content">
      <h3 class="title">@lang('main.your_created_courses')</h3>
    <a href="{{route("profile.course.create")}}" class="btn btn-add"><span class="icon"><i class="fas fa-plus"></i></span> @lang('main.сreate')</a>
      @include('profile.parts.tables.table-teaching')

    </main>
  </section>
</div>

@endsection
