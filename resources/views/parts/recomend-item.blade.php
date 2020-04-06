<div class="slide">
  <div class="recommend-item">
      <div class="recommend-item__img">
      <img src="{{asset("storage/".$course->image)}}" alt="картинка курса">
      </div>
      <div class="recommend-item__info">
          <h3 class="recommend-item__title">
            {{$course->title}}
          </h3>
          <div class="recommend-item__category">
            {{$course->category->title}}
          </div>
          <div class="recommend-item__desc">
            {{$course->description}}
          </div>

          <div class="recommend-item-bottom">
              <div class="recommend-item__author">
                  <span class="icon"><i class="fas fa-user"></i></span><span class="name">{{$course->author->name}} {{$course->author->lastname}}</span>
              </div>
              <a href="{{route("course.show", $course)}}" class="btn  recommend-item__btn">Перейти</a>

          </div>
      </div>
  </div>
</div>