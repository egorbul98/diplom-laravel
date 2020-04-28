
  <div class="module shadow-light">
      <div class="module-list-steps">
        @php
            $count2 = $module->steps->where("type_step_id", 2)->count();
            $count3 = $module->steps->where("type_step_id", 3)->count();
        @endphp
          <p class="module-list-steps__item">{{$module->steps->count()}} {{Lang::choice('main.step', $module->steps->count(), [], ($locale==null)? "ru" : $locale)}}</p>
          @if ($count2>0)
          <p class="module-list-steps__item">{{$count2}} {{Lang::choice('main.text_tasks', $count2, [], ($locale==null)? "ru" : $locale)}}</p>
          @endif
          @if ($count3>0)
          <p class="module-list-steps__item">{{$count3}} {{Lang::choice('main.numerical_tasks', $count3, [], ($locale==null)? "ru" : $locale)}}</p>
          @endif
         
      </div>
      
      <div class="module-inner">
          <div class="left">
              <h2 class="module__title">{{$module->title}}</h2>
              <div class="progress-line">
                @if ($module->steps->count()!=0)
                <div class="progress-line__fill" style="width: {{$module->progress_steps_for_user(Auth::user()->id)->get()->count()/$module->steps->count()*100}}%"></div>
                @else 
                  <div class="progress-line__fill" style="width: 0%"></div>
                @endif
              </div>
          </div>
          <div class="right">
              <p class="">@lang('main.after_mastering_the_module_you_will_receive'):</p>
              <div class="competencies">
                @foreach ($module->competences_out as $competence)
                  <p class="competencie">{{$competence->title}}</p>
                @endforeach
              </div>
          </div>
      </div>
      <form action="{{route("training.startModule", [$course->id, $section->id, $module->id])}}" method="POST" id="form-start-module{{$module->id}}">
        @csrf
        <a href="" class="module__link" onclick="event.preventDefault(); document.getElementById('form-start-module{{$module->id}}').submit();"></a>
      </form>
      
  </div>
