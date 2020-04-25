@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')

<div class="lesson-content__header">
    <h1 class="title">@lang('main.section') <span class="num">1</span>. <span class="text">{{$section->title}}</span></h1>
    <p class="desc">{{$section->description}}</p>
</div>


@php $section_competences = $section->competences_out_modules(); @endphp
@if ($section_competences->count()>0)
<div class="info-wrap">
    <div class="info-wrap__left shadow-light">
        <h3 class="title">В этом разделе вы освоите <span class="num">{{$section_competences->count()}}</span> навыков</h3>
        <div class="competences-list">
            {{-- {{$section->competences_out_modules()}} --}}
          @foreach ($section_competences as $competence)
            <div class="competence">{{$competence->title}}</div>
          @endforeach
        </div>
    </div>

    <div class="info-wrap__middle shadow-light">
        <h3 class="title">Сейчас освоили <span class="num">{{count($competences_user)}}</span> навыков</h3>
        <div class="competences-list">
            @foreach ($competences_user as $competence)
            <div class="competence">{{$competence->title}}</div>
            @endforeach
        </div>
    </div>
</div>

@endif
<div class="lesson-content__module-wrap">
    @if (isset($modules[0]))
        <h2 class="title">Модули для прохождения</h2>
        @foreach ($modules as $module)
            @include('training.parts.module-item', $module)
        @endforeach
    @else 
    <h2 class="title">Вы прошли все модули данного раздела, <a href="#" class="link">перейдите в следующий раздел</a> или повторите уже пройденные модули</h2>
    @endif
</div>

@if (isset($modules_completed[0]))
<div class="lesson-content__learned-modules">
    <h2 class="title">Модули, которые вы изучили</h2>
    <div class="lesson-content__slider">
    @foreach ($modules_completed as $item_module)

        <div class="slide">
            <div class="module shadow-light">
                <div class="module-inner">
                    <h2 class="module__title">{{$item_module->title}}</h2>
                    <div class="right">
                        <p class="">Полученные компетенции:</p>
                        <div class="competencies">
                            @foreach ($item_module->competences_out as $competence)
                                <p class="competencie">{{$competence->title}}</p>
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
