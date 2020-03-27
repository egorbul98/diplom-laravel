@if (isset($step))
<div class="main-wrap">
  <section class="step-editor">
      <div class="step-editor-header flex-b">
          <div class="step-editor-header__title"><span class="step-text">Шаг 11</span>|<span
                  class="step-type">{{$step->type->title}}</span></div>
          <button class="step-editor-header__btn-del btn"><span class="icon"><i
                      class="fas fa-times"></i></span>Удалить</button>
      </div>
      <div class="step-editor-content">
          <form action="">
              <textarea id="summernote" name="content">{{$step->content}}</textarea>
          </form>
      </div>
  </section>

  <div class="wrap-step-answer">
    @include('profile.edit-module.parts.step-answer')
</div>
<button class="btn" id="btn-add-answer">Добавить еще правильный ответ</button>
</div>




@endif


