

<form action="{{route("training.startCourse", [$course->id])}}" method="POST">
  @csrf
  <button type="submit" class="btn sidebar__btn">Начать обучение</button>
</form>
      <div class="sidebar__item ">
        <div class="sidebar__title">@lang('main.total_rating')</div>
        @php $avg = $course->reviews->avg("stars"); 
            $modulo = ($avg*10)%10;//Остаток от деления.
            $bool = true; @endphp
        <ul class="assessments">
          <div class="assessment">{{$avg}}</div>
          @for ($i = 1; $i < 6; $i++)
            @if ($i <= $avg)
              <li class="active"><i class="fas fa-star"></i></li>
            @elseif($modulo!=0 && $bool)
              <li class="active"><i class="fas fa-star-half-alt"></i></li>
              @php $bool=false @endphp
            @else 
              <li><i class="fas fa-star"></i></li>
            @endif
          
          @endfor
        </ul>
      </div>
      <div class="sidebar__item">
        <div class="sidebar__title">@lang('main.the_course_includes')</div>
        <div class="sidebar-list-info">
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 1)->count()}}</span><span class="text">{{Lang::choice('main.theoretical_modules', $steps->where("step_type_id", 1)->count(), [], ($locale==null)? "ru" : $locale)}}</span>
          </div>
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 2)->count()}}</span><span class="text">{{Lang::choice('main.text_tasks', $steps->where("step_type_id", 2)->count(), [], ($locale==null)? "ru" : $locale)}}</span>
          </div>
          <div class="sidebar-list-info__item">
            <span class="num">{{$steps->where("step_type_id", 3)->count()}}</span><span class="text">{{Lang::choice('main.numerical_tasks', $steps->where("step_type_id", 3)->count(), [], ($locale==null)? "ru" : $locale)}}</span>
          </div>
        </div>
        <div class="updated"><span class="text">@lang('main.last_update'): </span><span>@php if($course->updated_at!=null) echo $course->updated_at->format("d.m.Y")@endphp</span></div>
      </div>

      <div class="sidebar__item">
        <div class="sidebar__title">@lang('main.social_networks')</div>
        <ul class="social-list">
          <div class="social-list__item"><a href="#"><i class="fab fa-twitter-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-facebook-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-google-plus-square"></i></a></div>
        </ul>
      </div>