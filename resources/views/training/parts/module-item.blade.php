
  <div class="module shadow-light">
      <div class="module-list-steps">
        @php
            $count2 = $module->steps->where("type_step_id", 2)->count();
            $count3 = $module->steps->where("type_step_id", 3)->count();
        @endphp
          <p class="module-list-steps__item">{{$module->steps->count()}} шага</p>
          @if ($count2>0)
          <p class="module-list-steps__item">{{$count2}} текстовые задачи</p>
          @endif
          @if ($count2>0)
          <p class="module-list-steps__item">{{$count3}} числовые задачи</p>
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
              <p class="">После освоения модуля вы получите:</p>
              <div class="competencies">
                @foreach ($module->competences_out as $competence)
                  <p class="competencie">{{$competence->title}}</p>
                @endforeach
              </div>
          </div>
      </div>
      <a href="{{route("training.module", [$course->id, $section->id, $module->id])}}" class="module__link"></a>
  </div>
