@if ($course->exists)
  <form class="form" action="{{route("profile.course.update", $course->id)}}" method="POST" enctype="multipart/form-data">
  @method("PUT")

@else
<form class="form" action="{{route("profile.course.store")}}" method="POST" enctype="multipart/form-data">
  <div>
@endif
  @csrf
  <div class="tabs-container">
    @include('parts.tabs-btns')
   @foreach ($listLanguages as $lang)

    @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
    <div class="tab  @if ($locale == $lang || ($locale == null && $lang=="ru")) tab--active @endif " data-tab="{{$lang}}">
     
        <div class="form-row">
          <div class="form-row__left">
          <p><label class="" for="title{{$postfix}}">@lang('main.title')<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <input class="input-control" maxlength="64" id="title{{$postfix}}" name="title{{$postfix}}" type="text" value="{{old("title$postfix", $course["title$postfix"])}}">
            <div class="form-field__tooltip">
              {{-- <span class="text">{{Lang::line('main.tooltips.characters_max', array('num' => 'Taylor'))->get()}}</span> --}}
              <span class="text">@lang('main.tooltips.characters_max', ["num"=> 64])</span>
            </div>
          </div>
        </div>
      
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="description{{$postfix}}">@lang('main.short_description')<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <textarea name="description{{$postfix}}" id="description{{$postfix}}" rows="10">{{old("description$postfix", $course["description$postfix"])}}</textarea>
            <div class="form-field__tooltip">
              <span class="text">@lang('main.tooltips.characters_max', ["num"=> 200])</span>
            </div>
          </div>
        </div>
      
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="content{{$postfix}}">@lang('main.about_the_course')<span class="required-input">*</span></label></p>
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
    <p><label class="" for="content">@lang('main.select_a_category')<span class="required-input">*</span></label></p>
  </div>
  <div class="form-row__right form-field">
    
    <select name="category_id" class="section-categories">
      @foreach ($categories as $category)
        <option value="{{$category->id}}" @if ($category->id == $course->category_id) selected @endif>{{$category->__("title")}}</option>
      @endforeach
    </select>

  </div>
</div>

 <div class="form-row">
  <div class="form-row__left">
    <p><label class="" for="edit-foto">@lang('main.picture')</label></p>
  </div>
  <div class="form-row__right form-field">
    <div class="new-course__img">
    <img src="{{asset('/storage/'.$course->image)}}" alt=""><span class="icon"><i class="fas fa-camera"></i></span>
      <label for="image" class="edit-foto"><i class="fas fa-edit"></i></label>
    </div>
    <input type="file" id="image" name="image" style="display: none">
    <label for="image" class="edit-foto"><p class="link-upload">@lang('main.upload')</p></label>
  </div>
</div>

 <div class="form-row">
  <div class="form-row__left">
    <p><label class="" for="knowledge_to_repeat">@lang('main.the_percentage_of_knowledge_at_which_the_module_will_repeat')</label></p>
  </div>
  <div class="form-row__right form-field">
    <input class="input-control" type="number" min="1" max="99" id="knowledge_to_repeat" name="knowledge_to_repeat" type="text" value="{{old("knowledge_to_repeat", $course->knowledge_to_repeat)}}" placeholder="@lang('main.example'), 40"><span> %</span>
  </div>
</div>

  <div class="form-btns-wrap">
    @if ($course->exists)
      <button class="btn" type="submit"><span class="icon m-r-8"><i class="fas fa-save"></i></span> @lang('main.save')</button>
    @else
      <button class="btn" type="submit">@lang('main.сreate')</button>
    @endif
    @if ($course->exists)
      <a href="{{route("profile.course.sections.edit", compact("course"))}}" class="btn">@lang('main.go_to_section_editing')</a>
    @endif
    <a href="{{route("profile.course.index")}}" class="btn">@lang('main.go_to_course_list')</a>
  </div>

</form>