<section class="course-sections">
  @php  $i = 0; @endphp
  @foreach ($course->sections as $section)
  @php $j = 0; @endphp
  <div class="course-sections-item ">
    <div class="course-sections-item__inner shadow-light">
      <div class="course-sections-item__header">
        <h3 class="course-sections-item__title"><span class="num">{{++$i}}</span>{{$section->__("title")}}</h3>
        <p class="course-sections-item__count-models"><span>{{$section->modules->count()}}</span> {{Lang::choice('main.secitions_modules', $section->modules->count(), [], ($locale==null)? "ru" : $locale)}}</p>
      </div>
      <p class="course-sections-item__desc">{{$section->__("description")}}</p>
    </div>
    <div class="list-modules shadow-light">
      @foreach ($section->modules as $module)
        @php  $j++; @endphp
       
        @include('profile.edit-course.parts.modules-item', [$module, $section])
      @endforeach
     
    </div>
  </div>
  @endforeach
  
  @if (!isset($course->sections[0]))
      @lang('main.there_is_nothing')
  @endif
  
</section>