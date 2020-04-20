<aside class="lesson-sidebar">
  <div class="lesson-sidebar__header">
    <h4 class="lesson-title"><a href="{{route("training.course", [$course->id])}}">{{$course->title}}</a></h4>
    @php
        $sections_completed = $course->progress_sections_completed;
        $procent = round(count($sections_completed)/count($course->sections)*100);
        // dd(count($sections_completed),count($course->sections));
    @endphp
    <div class="lesson-progress"><span>Прогресс по курсу: </span><span class="progress">{{$procent}}%</span>
      <div class="progress-line">
        <div class="progress-line__fill" style="width: {{$procent}}%"></div>
      </div>
    </div>
  </div>
  <div class="lesson-sidebar__content">
    @php $i = 0; 
      $sections_completed_ids = Auth::user()->sections_completed_ids($course->id); 
    @endphp
        {{-- @dd($sections_completed_ids) --}}
    @foreach ($course->sections as $item_section)
    @if (isset($section))
      <div class="section @if ($item_section->id == $section->id) active @else @if(in_array($item_section->id, $sections_completed_ids)) completed @endif  @endif ">
    @else 
    <div class="section @if(in_array($item_section->id, $sections_completed_ids)) completed @endif">
    @endif
      <h5 class="text"><span class="num">{{++$i}}</span>{{$item_section->title}}</h5>
      {{-- <div class="tooltip">
        <h5>Общая информация о курсе wqdqw d qwd qw</h5>
        <p class="desc">Чтобы открыть раздел, нужно пройти предыдущие</p>
      </div> --}}
      <a href="{{route("training.section", [$course->id, $item_section->id])}}" class="overlay"></a>
    </div>
    @endforeach
    
  
  </div>

  <h4>Последние достижения</h4>
  <div class="lesson-sidebar__competences">
    @foreach ($user->competences_out_for_course($course->id) as $competence)
    <div class="competence">{{$competence->title}}</div>
    @endforeach
  </div>
</aside>