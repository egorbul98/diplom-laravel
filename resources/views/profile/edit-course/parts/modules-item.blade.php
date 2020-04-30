<div class="list-modules-item">
  <h4 class="list-modules-item__title"><span class="num">{{$i}}.{{$j}}</span>{{$module->__("title")}}</h4>
<p class="list-modules-item__steps"><span>{{$module->steps->count()}}</span> {{Lang::choice('main.step', $module->steps->count(), [], ($locale==null)? "ru" : $locale)}}</p>
  <a href="{{route("profile.course.module.edit", [$module, $section])}}" class="btn list-modules-item__btn">@lang('main.edit')</a>

</div>