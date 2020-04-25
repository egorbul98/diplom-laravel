

<form action="{{route("training.startCourse", [$course->id])}}" method="POST">
  @csrf
  <button type="submit" class="btn sidebar__btn">Начать обучение</button>
</form>
      <div class="sidebar__item ">
        <div class="sidebar__title">@lang('main.rating')</div>
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
        <div class="sidebar__title">@lang('main.the_course_includes')</div>
        <div class="sidebar-list-info">
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 1)->count()}}</span><span class="text">@lang('main.Theoretical_modules')</span>
          </div>
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 2)->count()}}</span><span class="text">@lang('main.text_tasks')</span>
          </div>
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 3)->count()}}</span><span class="text">@lang('main.numerical_tasks')</span>
          </div>
        </div>
        <div class="updated"><span class="text">@lang('main.last_update'): </span><span>{{$course->updated_at}}</span></div>
      </div>

      <div class="sidebar__item">
        <div class="sidebar__title">@lang('main.social_networks')</div>
        <ul class="social-list">
          <div class="social-list__item"><a href="#"><i class="fab fa-twitter-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-facebook-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-google-plus-square"></i></a></div>
        </ul>
      </div>