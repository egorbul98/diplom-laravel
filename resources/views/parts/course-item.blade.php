<div class="courses-item">
  <div class="courses-item__img">
      <img src="{{asset("storage/".$course->image)}}" alt="картинка курса">
  </div>
  <div class="courses-item__info">
      <h3 class="courses-item__title">
          {{$course->title}}
      </h3>

      <div class="courses-item__category">{{$course->category->title}}</div>

      <div class="courses-item__author">
          <span class="icon"><i class="fas fa-user"></i></span><span class="name">{{$course->author->name}} {{$course->author->lastname}}</span>
      </div>
  </div>
  <div class="courses-item__overlay">
      <h1>Открыть</h1>
  </div>
  <a href="{{route("course.show", $course)}}" class="ovelay-link"></a>
</div>