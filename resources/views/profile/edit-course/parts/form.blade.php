@if ($course->exists)
  <form class="form" action="{{route("profile.course.update", $course->id)}}" method="POST" enctype="multipart/form-data">
  @method("PUT")
@else
<form class="form" action="{{route("profile.course.store")}}" method="POST" enctype="multipart/form-data">
@endif
  @csrf
  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="title">Название<span class="required-input">*</span></label></p>
    </div>
    <div class="form-row__right form-field">
      <input class="input-control" maxlength="64" id="title" name="title" type="text" value="{{old("title", $course->title)}}">
      <div class="form-field__tooltip">
        <span class="text">Не более 64 символов</span>
      </div>
    </div>
  </div>


  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="description">Краткое описание<span class="required-input">*</span></label></p>
    </div>
    <div class="form-row__right form-field">
      <textarea name="description" id="description" rows="10">{{old("description", $course->description)}}</textarea>
      <div class="form-field__tooltip">
        <span class="text">Не более 200 символов</span>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="content">О курсе<span class="required-input">*</span></label></p>
    </div>
    <div class="form-row__right form-field">
      <textarea name="content" id="content" rows="10">{{old("content", $course->content)}}</textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="content">Выберите категорию<span class="required-input">*</span></label></p>
    </div>
    <div class="form-row__right form-field">
      
      <select name="category_id" class="section-categories">
        @foreach ($categories as $category)
          <option value="{{$category->id}}" @if ($category->id == $course->category_id) selected @endif>{{$category->title}}</option>
        @endforeach
      </select>

    </div>
  </div>

 

  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="edit-foto">Изображение</label></p>
    </div>
    <div class="form-row__right form-field">
      <div class="new-course__img">
      <img src="{{asset('/storage/'.$course->image)}}" alt=""><span class="icon"><i class="fas fa-camera"></i></span>
        <input type="file" id="image" name="image" style="">
        <label for="image" class="edit-foto"><i class="fas fa-edit"></i></label>
      </div>
    </div>
  </div>
 

  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="knowledge">Выберите процент знаний, при котором будет повторение модуля</label></p>
    </div>
    <div class="form-row__right form-field">
      <input class="input-control" type="number" min="1" max="99" id="knowledge" name="knowledge" type="text" value="{{old("knowledge", $course->knowledge)}}" placeholder="например, 40">%
    </div>
  </div>

  <div class="form-btns-wrap">
    @if ($course->exists)
      <button class="btn" type="submit"><span class="icon m-r-8"><i class="fas fa-save"></i></span> Сохранить</button>
    @else
      <button class="btn" type="submit">Создать</button>
    @endif
    @if ($course->exists)
      <a href="{{route("profile.course.sections.edit", compact("course"))}}" class="btn">Перейти к редактированию разделов</a>
    @endif
    <a href="{{route("profile.course.index")}}" class="btn">Перейти к списоку курсов</a>
  </div>

</form>