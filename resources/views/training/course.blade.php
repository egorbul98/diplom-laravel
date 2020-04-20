@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')

<div class="lesson-content__header">
    <h1 class="title">{{$course->title}}</h1>
    <p class="desc">{{$course->description}}</p>
</div>
<br>

@if (isset($module_for_repeat[0]))
<h2 class="title necessary">Вам необходимо</h2>
<div class="lesson-content-wrapper">

    @if($module_for_repeat->where("test_id", "!=", null)->first()!= null)
    <div class="lesson-content__tests">
        <h2 class="title">Пройти тест</h2>
        <div class="test shadow-light">
            <h3 class="title">Тест включает вопросы из следующих модулей</h3>
            <div class="test__list-modules">
                @foreach ($module_for_repeat as $module)
                @if(isset($module->test))
                <div class="test__module">
                    <p class="name">{{$module->title}}</p>
                    <div class="section">{{$module->test->title}}</div>
                </div>
                @endif
                @endforeach

            </div>
            <a href="{{route("training.forgotTest", [$course->id])}}" class="test__link"></a>
        </div>
    </div>
    @endif
    <div class="lesson-content__module-wrap">
        <h2 class="title">Повторить следующие модули</h2>

        @foreach ($module_for_repeat as $module)
        @php
        $section = App\Models\Section::find($module->pivot->section_id);
        @endphp
        @include('training.parts.module-item', [$module, $section])
        @endforeach

    </div>

</div>
@endif
@endsection
