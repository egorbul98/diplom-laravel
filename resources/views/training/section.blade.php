@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')

<div class="lesson-content__header">
    <h1 class="title">Раздел <span class="num">1</span>. <span class="text">{{$section->title}}</span></h1>
    <p class="desc">{{$section->description}}</p>
</div>

@if ($section->competences->count()>0)

<div class="info-wrap">
    <div class="info-wrap__left shadow-light">
        <h3 class="title">В этом разделе вы освоите <span class="num">{{$section->competences->count()}}</span> навыков</h3>
        <div class="competences-list">
          @foreach ($section->competences as $competence)
            <div class="competence">{{$competence->title}}</div>
          @endforeach
        </div>
    </div>
    <div class="info-wrap__middle shadow-light">
        <h3 class="title">Сейчас освоили <span class="num">5</span> навыков</h3>
        <div class="competences-list">
            <div class="competence">Умение считать</div>
            <div class="competence">Умение писать</div>
            <div class="competence">Знание пользоваться пультом от телевизора</div>
            <div class="competence">Умение считать</div>
            <div class="competence">Умение писать</div>
            <div class="competence">Умение считать</div>
            <div class="competence">Умение писать</div>
        </div>
    </div>
</div>

@endif
<div class="lesson-content__module-wrap">
    <h2 class="title">Модули для прохождения</h2>
    @if (isset($modules))
        @foreach ($modules as $module)
            @include('training.parts.module-item', $module)
        @endforeach
    @endif
</div>

<div class="lesson-content__learned-modules">
    <h2 class="title">Модули, которые уже изучены</h2>

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
            </div>
        </div>

    @endforeach
        
    </div>

</div>





@endsection
