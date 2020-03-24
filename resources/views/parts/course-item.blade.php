<div class="courses-item">
  <div class="courses-item__img">
      <img src="{{asset("img/header-bg.jpg")}}" alt="картинка курса">
  </div>
  <div class="courses-item__info">
      <h3 class="courses-item__title">
          {{$course->title}}
      </h3>

      <div class="courses-item__category">
          Программирование {{$course->category_id}}
      </div>

      <div class="courses-item__author">
          <span class="icon"><i class="fas fa-user"></i></span><span class="name">{{$course->author->name}}</span>
      </div>
  </div>
  <div class="courses-item__overlay">
      <a href="{{route("course.show", $course)}}" class="ovelay-link"></a>
      <h1>Открыть</h1>
  </div>

</div>