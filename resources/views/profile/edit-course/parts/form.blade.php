@if ($course->exists)
  <form class="form" action="{{route("profile.course.update", $course->id)}}" method="POST" enctype="multipart/form-data">
  @method("PUT")
  <div class="tabs-container">

    @include('parts.tabs-btns')

@else
<form class="form" action="{{route("profile.course.store")}}" method="POST" enctype="multipart/form-data">
  <div>
@endif
  @csrf
 
   @foreach ($listLanguages as $lang)

    @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
    <div class="tab  @if ($locale == $lang || ($locale == null && $lang=="ru")) tab--active @endif " data-tab="{{$lang}}">
     
        <div class="form-row">
          <div class="form-row__left">
          <p><label class="" for="title{{$postfix}}">Название<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <input class="input-control" maxlength="64" id="title{{$postfix}}" name="title{{$postfix}}" type="text" value="{{old("title$postfix", $course["title$postfix"])}}">
            <div class="form-field__tooltip">
              <span class="text">Не более 64 символов</span>
            </div>
          </div>
        </div>
      
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="description{{$postfix}}">Краткое описание<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <textarea name="description{{$postfix}}" id="description{{$postfix}}" rows="10">{{old("description$postfix", $course["description$postfix"])}}</textarea>
            <div class="form-field__tooltip">
              <span class="text">Не более 200 символов</span>
            </div>
          </div>
        </div>
      
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="content{{$postfix}}">О курсе<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <textarea name="content{{$postfix}}" id="content{{$postfix}}" rows="10">{{old("content$postfix", $course["content$postfix"])}}</textarea>
          </div>
        </div>
       
    </div>
  @endforeach

   

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
    <p><label class="" for="knowledge_to_repeat">Процент знаний, при котором будет повторение модуля</label></p>
  </div>
  <div class="form-row__right form-field">
    <input class="input-control" type="number" min="1" max="99" id="knowledge_to_repeat" name="knowledge_to_repeat" type="text" value="{{old("knowledge_to_repeat", $course->knowledge_to_repeat)}}" placeholder="например, 40">%
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