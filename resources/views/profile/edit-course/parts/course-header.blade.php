<div class="main-wrap">
  <section class="course-header" data-course-id="{{$course->id}}">
    <div class="profile-header__img">
    <img src="{{asset("storage/".$course->image)}}" alt=""><span class="icon"><i class="fas fa-camera"></i></span>

      <form action="">
        <a href="{{route("profile.course.edit", $course)}}" class="edit-foto"><i class="fas fa-edit"></i></a>
      </form>
    </div>
    <div class="course-header-title">
      <h2 class="title">{{$course->title}}</h2>
      <p class="category">{{$course->category->title}}</p>
      <p class="status">Курс в разработке</p>
    </div>
    <div class="course-header-menu">
      <button type="button" class="btn">Меню</button>
      <div class="drop-down shadow-light">
        
        <p class="drop-down__item"><a href="{{route("profile.course.graph", $course->id)}}">Показать деревья модулей</a></p>
        <p class="drop-down__item"><a href="{{route("profile.course.edit", $course->id)}}">Редактировать описание</a></p>
        <p class="drop-down__item"><a href="{{route("profile.course.sections.edit", $course)}}">Редактировать разделы курса</a></p>
        <p class="drop-down__item"><a id="delete-course" href="{{route("profile.course.destroy", $course)}}">Удалить</a></p>

      </div>

      <form action="{{route("profile.course.destroy", $course->id)}}" style="display:none" id="form-delete" method="POST">
        @method("DELETE")
        @csrf
      </form>
    </div>
  </section>
</div>
