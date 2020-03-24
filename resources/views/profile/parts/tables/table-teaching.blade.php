<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Название</th>
        
        <th>Дата обновления</th>
        <th>Опубликован</th>

        <th></th>
      </tr>
    </thead>
    <tbody>

      @foreach (Auth::user()->courses as $course)
        <tr>
          <td class="table-img"><img src="{{asset("img/course.jpg")}}" alt="img"></td>
        <td class="profile-content-table-course__title">{{$course->title}}</td>
          
          <td class="vertical-m">{{$course->updated_at}}</td>
          <td class="vertical-m">Нет</td>
          
        <td class="table-btn vertical-m"><a href="{{route("profile.course.show", $course)}}" class="btn">Перейти</a></td>
        </tr>
      @endforeach
      
      
     
    </tbody>
  </table>
</div>