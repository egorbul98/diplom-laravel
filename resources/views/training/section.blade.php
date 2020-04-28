@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')

<div class="lesson-content__header">
    <h1 class="title">@lang('main.section') <span class="num">1</span>. <span class="text">{{$section->__("title")}}</span></h1>
    <p class="desc">{{$section->__("description")}}</p>
</div>


@php $section_competences = $section->competences_out_modules(); @endphp
@if ($section_competences->count()>0)
<div class="info-wrap">
    <div class="info-wrap__left shadow-light">
        <h3 class="title">@lang('main.in_this_section_you_will_learn') <span class="num">{{$section_competences->count()}}</span> {{Lang::choice('main.skill', $section_competences->count(), [], ($locale==null)? "ru" : $locale)}}</h3>
        <div class="competences-list">
            {{-- {{$section->competences_out_modules()}} --}}
          @foreach ($section_competences as $competence)
            <div class="competence">{{$competence->__("title")}}</div>
          @endforeach
        </div>
    </div>

    <div class="info-wrap__middle shadow-light">
        <h3 class="title">@lang('main.now_mastered') <span class="num">{{count($competences_user)}}</span> {{Lang::choice('main.skill', count($competences_user), [], ($locale==null)? "ru" : $locale)}}</h3>
        <div class="competences-list">
            @foreach ($competences_user as $competence)
            <div class="competence">{{$competence->__("title")}}</div>
            @endforeach
        </div>
    </div>
</div>

@endif
<div class="lesson-content__module-wrap">
    @if (isset($modules[0]))
        <h2 class="title">@lang('main.modules_for_passing')</h2>
        @foreach ($modules as $module)
            @include('training.parts.module-item', $module)
        @endforeach
    @else 
    <h2 class="title">@lang('main.you_have_completed_all_the_modules_in_this_section.'), <a href="#" class="link">@lang('main.go_to_the_next_section.')</a> @lang('main.or_repeat_already_completed_modules.')</h2>
    @endif
</div>

@if (isset($modules_completed[0]))
<div class="lesson-content__learned-modules">
    <h2 class="title">@lang('main.modules_you_learned.')</h2>
    <div class="lesson-content__slider">
    @foreach ($modules_completed as $item_module)

        <div class="slide">
            <div class="module shadow-light">
                <div class="module-inner">
                    <h2 class="module__title">{{$item_module->__("title")}}</h2>
                    <div class="right">
                        <p class="">@lang('main.competencies_gained.'):</p>
                        <div class="competencies">
                            @foreach ($item_module->competences_out as $competence)
                                <p class="competencie">{{$competence->__("title")}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{{route("training.module", [$course->id, $section->id, $item_module->id])}}" class="module__link"></a>
            </div>
        </div>

    @endforeach
    </div>
</div>
@endif




@endsection
