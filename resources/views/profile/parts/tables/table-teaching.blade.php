<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>@lang('main.title')</th>
        
        <th>@lang('main.update_date')</th>
        <th>@lang('main.published')</th>

        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($user->courses()->paginate(8) as $course)
      @php  $timeUpdated = Carbon\Carbon::parse($course->updated_at)->addHours(45)->format("d.m.Y h:i"); @endphp
        <tr>
          <td class="table-img"><img src="{{asset("storage/".$course->image)}}" alt="img"></td>
        <td class="profile-content-table-course__title">{{$course->__("title")}}</td>
          
          <td class="vertical-m">
            {{$timeUpdated}}
          </td>
          <td class="vertical-m">Нет</td>
          
        <td class="table-btn vertical-m"><a href="{{route("profile.course.show", $course)}}" class="btn">@lang('main.go_to')</a></td>
        </tr>
      @endforeach
      
      
     
    </tbody>
  </table>
</div>


  <section class="paginate center">
    {{$user->courses()->paginate(8)->links()}}
  </section>
