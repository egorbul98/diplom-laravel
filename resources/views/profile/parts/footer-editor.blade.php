<footer class="footer-editor">
  <div class="main-wrap">
    <div class="footer-editor-wrap">
      @if (isset($course))
        <a href="{{route("profile.course.show", $course)}}" class="btn btn-gray">Вернуться</a>
        <a href="{{route("profile.course.sections.save", $course->id)}}" class="btn" id="btn-save-sections">Сохранить</a>
      @else
        <a href="{{route("profile.course.show", $module->section->course)}}" class="btn btn-gray">Вернуться</a>
        <a href="{{route("profile.course.module.save", $module->id)}}" class="btn" id="btn-save-sections">Сохранить</a>
      @endif
   
    </div>
  </div>
</footer>