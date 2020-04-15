

<a href="{{route("training.course", [$course->id])}}" class="btn sidebar__btn">Начать обучение</a>
      <div class="sidebar__item ">
        <div class="sidebar__title">Оценки</div>
        <ul class="assessments">
          <li class="assessment">3,5</li>
          <li><i class="fas fa-star"></i></li>
          <li><i class="fas fa-star"></i></li>
          <li><i class="fas fa-star"></i></li>
          <li><i class="fas fa-star-half-alt"></i></li>
          <li><i class="far fa-star"></i></li>
        </ul>
      </div>
      <div class="sidebar__item">
        <div class="sidebar__title">В курс входят</div>
        <div class="sidebar-list-info">
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 1)->count()}}</span><span class="text">Теоретических модулей</span>
          </div>
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 2)->count()}}</span><span class="text">Текстовых задач</span>
          </div>
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 3)->count()}}</span><span class="text">Числовых задач</span>
          </div>
        </div>
        <div class="updated"><span class="text">Последнее обновление: </span><span>{{$course->updated_at}}</span></div>
      </div>

      <div class="sidebar__item">
        <div class="sidebar__title">Социальные сети</div>
        <ul class="social-list">
          <div class="social-list__item"><a href="#"><i class="fab fa-twitter-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-facebook-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-google-plus-square"></i></a></div>
        </ul>
      </div>