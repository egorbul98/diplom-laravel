@foreach ($listLanguages as $lang)

@php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
<div class="tab  @if ($locale == $lang || ($locale == null && $lang=="ru")) tab--active @endif " data-tab="{{$lang}}">

<div class="course-sections-item"  data-section-id="{{$section->id}}">
  <div class="course-sections-item__inner section-edit shadow-light">
    <div class="section-edit-wrap">
      <div class="section-edit-wrap__num">{{$i}}</div>
      <div class="section-edit-wrap__inputs">
        <div class="">
         
          <div class="form-field">
            <input class="input-control input-title" name="title{{$postfix}}[{{$section->id}}]" id="title{{$postfix}}" type="text" maxlength="128" value="{{$section["title$postfix"]}}">
            
          </div>
        </div>

        <div class="">
          <div class="form-field">
          <textarea name="description{{$postfix}}[{{$section->id}}]" id="" cols="30" rows="5" class="description">{{ $section["description$postfix"]}}</textarea>
          
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="list-modules shadow-light" data-section-id="{{$section->id}}" data-author-id="{{$user->id}}">
    <div class="list-modules-item">

      <h4 class="list-modules-item__inner">
        <input type="text" class="input-control input-create-module" placeholder="Название модуля">
      </h4>
      <div class="list-modules-item__btns">
        <button type="button" class="btn btn-create-module  list-modules-item__btn" data-section-id="{{$section->id}}">Создать модуль</button>
        <button type="button" class="btn btn-add-module  list-modules-item__btn" data-section-id="{{$section->id}}">Добавить существующий</button>
      </div>
      
    </div>
    <div class="list-modules-inner">
      @php  $j = 0; @endphp
      @foreach ($section->modules as $module)
        <div class="list-modules-item">
          <h4 class="list-modules-item__inner">
            <span class="num">{{$i}}.{{++$j}}</span>
            <input type="text" name="module-title{{$postfix}}[{{$module->id}}]" class="input-control input-bg" value="{{$module["title$postfix"]}}" placeholder="Название модуля">
          </h4>
        <p class="list-modules-item__steps"><span>{{$module->steps->count()}}</span> шагов</p>
          <div class="list-modules-item__btns">
            <a href="{{route("profile.course.module.edit", [$module, $section])}}" class="btn ">@lang('main.edit')</a>
            <button type="button" class="btn-delete-module" data-module-id="{{$module->id}}"><i class="fas fa-times"></i></button>
          </div>
        </div>
      @endforeach

    </div>
  </div>
  <button type="button" class="btn-delete-section" data-section-id="{{$section->id}}"><i class="fas fa-times"></i></button>
</div>

</div>

@endforeach
