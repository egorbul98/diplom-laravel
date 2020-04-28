
<div class="courses-item">
  <div class="courses-item__img">
      <img src="{{asset("storage/".$course->image)}}" alt="картинка курса">
  </div>
  <div class="courses-item__info">
      <h3 class="courses-item__title">
          {{$course->__("title")}}
      </h3>

      <div class="courses-item__category">{{$course->category->__("title")}}</div>

      <div class="courses-item__author">
          <span class="icon"><i class="fas fa-user"></i></span><span class="name">{{$course->author->name}} {{$course->author->lastname}}</span>
      </div>
  </div>
  <div class="courses-item__overlay">
      <h1>@lang('main.open')</h1>
  </div>
  <a href="{{route("course.show", $course)}}" class="ovelay-link"></a>
</div>