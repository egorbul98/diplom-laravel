<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Название</th>
        <th>Прогресс</th>
        <th>Дата начала</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach ($user->progress_courses as $course)
       
      <tr>
        <td class="table-img"><img src="{{asset("storage/".$course->image)}}" alt=""></td>
        <td class="profile-content-table-course__title">{{$course->title}}</td>
      <td><div class="progress-line"><div class="progress-line__fill" style="width: {{$user->modules_completed_for_course($course->id)->get()->count()/$course->modules->count()*100}}%"></div></div></td>

        <td>{{$course->created_at}}</td>
        <td class="table-btn"><a href="{{route("training.course", [$course->id])}}" class="btn">Перейти</a></td>
      </tr>
      @endforeach
      
    
    </tbody>
  </table>
</div>