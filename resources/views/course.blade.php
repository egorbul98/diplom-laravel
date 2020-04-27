{{-- @extends('layouts.app') --}}
@extends('layouts.default')

@section('class-body')
  item-page
@endsection

@section('content')

<div class="item-header shadow">
  <div class="main-wrap">
    <div class="item-header-wrap">
      <div class="item-header__info">
        <h1 class="item-header__title">{{$course->__('title')}}</h1>
        <div class="item-header__desc">{{$course->description}}</div>
        <div class="item-header__author"><span class="icon"><i class="fas fa-user"></i></span><span
            class="name">{{$course->author->name}} {{$course->author->lastname}}</span></div>
      </div>
      <div class="item-header__img">
        <img src="{{asset("storage/".$course->image)}}" alt="">
      </div>
    </div>
  </div>
  <div class="background"></div>
</div>


<div class="main-wrap">
  <main class="content">
    <article class="item-content">
      <section class="item-body item-content__section">
        <h2 class="title">О курсе</h2>
        <p class="paragraph">
          {{$course->content}}
        </p>
      </section>

      <section class="item-sections item-content__section">
        <h2 class="title">Чему вы научитесь</h2>
     
        @for ($i = 0; $i < $course->sections->count(); $i++)
          @include('parts.course.section-item') 
        @endfor
        {{-- @foreach ($course->sections as $section)
          
        @endforeach --}}
         
      </section>


      <section class="item-content__section reviews ">
        <h2 class="title">Отзывы о курсе</h2>
        @php $reviews = $course->reviews()->paginate(8); @endphp
        @forelse ($reviews as $review)
          @include('parts.course.revews-item') 
        @empty
            @lang('main.there_is_nothing')
        @endforelse
      
       
        <section class="paginate center">
          {{$reviews->links()}}
        </section>
      </section>

    </article>
    <aside class="sidebar">
      @include('parts.course.sidebar') 
    </aside>
  </main>
</div>


</section>
@endsection
