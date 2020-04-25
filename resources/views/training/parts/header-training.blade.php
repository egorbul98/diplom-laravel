
  <header class="lesson-header">
    <div class="lesson-header-inner">
      <button class="btn-gamburger" type="button"><i class="fas fa-bars"></i></button>
      <h2 class="lesson-header__logo"><a href="{{route("home")}}">@lang('main.online_courses')</a></h2>
    </div>
    <div class="lesson-header__user">
    <div class="lesson-header__name"><span class="lastname">{{$user->lastname}}</span><span class="firstname">{{$user->name}}</span></div>
      <div class="icon"><i class="fas fa-chevron-down"></i></div>
      <div class="drop-down">
        <div class="drop-down__item"><a href="{{route("profile")}}">@lang('main.personal_area')</a></div>
        <div class="drop-down__item"><a href="{{route("training.learning-path", $course->id)}}">@lang('main.learning-path')</a></div>
        <div class="drop-down__item"><a href="#" class="create_review">@lang('main.leave_feedback_about_this_course')</a></div>
        <form action="{{route("logout")}}" id="logout-form" method="POST" class="form">
          @csrf
          {{-- <div class="drop-down__item"><a href="{{route("logout")}}">@lang('main.logout')</a></div> --}}
          <div class="drop-down__item"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('main.logout')</a></div>
        </form>
       
      </div>
    </div>
  </header>