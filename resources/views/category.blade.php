{{-- @extends('layouts.app') --}}
@extends('layouts.default')

@section('class-body')
list
@endsection

@section('content')

<section class="recommend-outer shadow">
  <div class="recommend">
      <div class="main-wrap">
          <div class="recommend-wrap">
              <h2 class="title">Рекомендуем к изучению</h2>
              <div class="recommend-list">
                @foreach ($courses as $course)
                  @include('parts.recomend-item', $course)
                @endforeach
              </div>
          </div>
      </div>
  </div>
</section>


<section class="title-outer">
  <h1 class="title">{{$category->title}}</h1>
  <div class="line"></div>
</section>
{{-- <h1 class="category-title"></h1> --}}
<section class="courses">
  <div class="main-wrap">
      <div class="courses-list">
          @foreach ($courses as $course)
              @include('parts.course-item', $course)
          @endforeach
          @if (!isset($courses))
              Ничего
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
