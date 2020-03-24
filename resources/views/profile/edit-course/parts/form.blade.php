<form class="form" action="{{route("profile.course.store")}}" method="POST">
  @csrf
  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="title">Название<span class="required-input">*</span></label></p>
    </div>
    <div class="form-row__right form-field">
      <input class="input-control" maxlength="64" id="title" name="title" type="text">
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
      <textarea name="description" id="description" rows="10"></textarea>
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
      <textarea name="content" id="content" rows="10"></textarea>

    </div>
  </div>
  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="content">Выберите категорию<span class="required-input">*</span></label></p>
    </div>
    <div class="form-row__right form-field">
      <select name="category_id" class="section-categories">
        <option value="1">Программирование</option>
        <option value="2">Web-разработка</option>
        <option value="3">Фотография</option>
        <option value="4">Дизайн</option>
      </select>

    </div>
  </div>

  
  <div class="form-row">
    <div class="form-row__left">
      <p><label class="" for="edit-foto">Изображение</label></p>
    </div>
    <div class="form-row__right form-field">
      <div class="new-course__img">
        <img src="img/course.jpg" alt=""><span class="icon"><i class="fas fa-user"></i></span>
        <input type="file" id="image" name="image" style="visibility: hidden;">
        <label for="image" class="edit-foto"><i class="fas fa-edit"></i></label>
      </div>

    </div>
    
  </div>

  <div class="form-btns-wrap">
    <button class="btn" type="submit">Создать</button>
    <a href="{{ url()->previous() }}" class="btn">Отмена</a>
  </div>

</form>