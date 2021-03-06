<div class="item-sections-item shadow-light">
  <div class="item-sections-item-inner">
    <div class="left">
      <div class="item-sections-item__section">@lang('main.section') {{$i+1}}</div>
      <div class="item-sections-item__name">{{$course->sections[$i]->__("title")}}</div>
    </div>
    <div class="icon-arrow"><i class="fas fa-chevron-left"></i></div>
  </div>
  <div class="item-sections-item__cometencies">
    @foreach ($course->sections[$i]->competences as $competence)
      <div class="competence">{{$competence->__("title")}}</div>
    @endforeach
  </div>
</div>