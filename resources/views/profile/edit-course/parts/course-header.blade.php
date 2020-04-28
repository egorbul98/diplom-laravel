<div class="main-wrap">
  <section class="course-header" data-course-id="{{$course->id}}">
    <div class="profile-header__img">
    <img src="{{asset("storage/".$course->image)}}" alt=""><span class="icon"><i class="fas fa-camera"></i></span>

      <form action="">
        <a href="{{route("profile.course.edit", $course)}}" class="edit-foto"><i class="fas fa-edit"></i></a>
      </form>
    </div>
    <div class="course-header-title">
      <h2 class="title">{{$course->__("title")}}</h2>
      <p class="category">{{$course->category->__("title")}}</p>
      <p class="status">Курс в разработке</p>
    </div>
    <div class="course-header-menu">
      <button type="button" class="btn">@lang('main.menu')</button>
      <div class="drop-down shadow-light">
        
        <p class="drop-down__item"><a href="{{route("profile.course.graph", $course->id)}}">@lang('main.show_module_trees')</a></p>
        <p class="drop-down__item"><a href="{{route("profile.course.edit", $course->id)}}">@lang('main.edit_description')</a></p>
        <p class="drop-down__item"><a href="{{route("profile.course.sections.edit", $course)}}">@lang('main.edit_course_sections')</a></p>
        <p class="drop-down__item"><a id="delete-course" href="{{route("profile.course.destroy", $course)}}">@lang('main.delete')</a></p>

      </div>

      <form action="{{route("profile.course.destroy", $course->id)}}" style="display:none" id="form-delete" method="POST">
        @method("DELETE")
        @csrf
      </form>
    </div>
  </section>
</div>
