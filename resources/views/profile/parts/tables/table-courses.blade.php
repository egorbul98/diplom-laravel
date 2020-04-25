<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>@lang('main.title')</th>
        <th>Прогресс</th>
        <th>Дата начала</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach ($user->progress_courses as $course)
      @php
        $sections_completed = $course->progress_sections_completed;
        $procent = count($sections_completed)/count($course->sections)*100;
        
      @endphp
      <tr>
        <td class="table-img"><img src="{{asset("storage/".$course->image)}}" alt=""></td>
        <td class="profile-content-table-course__title">{{$course->title}}</td>
      <td><div class="progress-line"><div class="progress-line__fill" style="width: {{$procent}}%"></div></div></td>

        <td>{{$course->created_at}}</td>
        <td class="table-btn"><a href="{{route("training.course", [$course->id])}}" class="btn">Перейти</a></td>
      </tr>
      @endforeach
      
    
    </tbody>
  </table>
</div>