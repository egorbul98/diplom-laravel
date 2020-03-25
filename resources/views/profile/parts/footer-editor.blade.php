<footer class="footer-editor">
  <div class="main-wrap">
    <div class="footer-editor-wrap">
    <a href="{{route("profile.course.show", $course)}}" class="btn btn-gray">Вернуться</a>
      <a href="{{route("profile.course.sections.save", $course->id)}}" class="btn" id="btn-save-sections">Сохранить</a>
    </div>
  </div>
</footer>