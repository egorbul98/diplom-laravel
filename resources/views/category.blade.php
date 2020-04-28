{{-- @extends('layouts.app') --}}
@extends('layouts.default')

@section('class-body')
list
@endsection

@section('content')

@include('parts.recommend-courses-section')

<section class="title-outer">
  <h1 class="title">{{$category->__("title")}}</h1>
  <div class="line"></div>
</section>
{{-- <h1 class="category-title"></h1> --}}
<section class="courses">
  <div class="main-wrap">
      <div class="courses-list">
          @foreach ($courses as $course)
              @include('parts.course-item', $course)
          @endforeach
          @if (!isset($courses[0]))
             <div class="nothing">@lang('main.there_is_nothing')</div>
          @endif
      </div>
</section>

<div class="main-wrap">
  <section class="paginate center">
    {{$courses->links()}}
  </section>
</div>


</section>
@endsection
