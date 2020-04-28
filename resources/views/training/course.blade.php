@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')

<div class="lesson-content__header">
    <h1 class="title">{{$course->__("title")}}</h1>
    <p class="desc">{{$course->__("description")}}</p>
</div>
<br>

@if (isset($module_for_repeat[0]))
<h2 class="title necessary">@lang('main.to_continue_your_studies_you_need_to'):</h2>
<div class="lesson-content-wrapper">
    @php
        $count = 0;
        foreach ($module_for_repeat as $module) {
            if(isset($module->test) && $module->test_completed()->first()!=null &&
            $module->test_completed()->first()->pivot->repeated == 0){ 
                $count++;
            }
        }
    @endphp
    @if($module_for_repeat->where("test_id", "!=", null)->first()!= null && $count>0)
    <div class="lesson-content__tests">
        <h2 class="title">@lang('main.take_the_test')</h2>
        <div class="test shadow-light">
            <h3 class="title">@lang('main.the_test_includes_questions_from_the_following_modules')</h3>
            <div class="test__list-modules">
                @foreach ($module_for_repeat as $module)

                @if(isset($module->test) && $module->test_completed()->first()!=null &&
                $module->test_completed()->first()->pivot->repeated == 0)
                <div class="test__module">
                    <p class="name">{{$module->__("title")}}</p>
                    <div class="section">{{$module->test->__("title")}}</div>
                </div>
                @endif
                @endforeach

            </div>
            <a href="{{route("training.forgotTest", [$course->id])}}" class="test__link"></a>
        </div>
    </div>
    @endif
    <div class="lesson-content__module-wrap">
        <h2 class="title">@lang('main.repeat_the_following_modules')</h2>

        @foreach ($module_for_repeat as $module)
        {{-- @dd($module->test_completed()->first()) --}}
        @if (( isset($module->test) && $module->test_completed()->first()!=null &&
        $module->test_completed()->first()->pivot->repeated == 1)|| !isset($module->test) ||
        $module->test_completed()->first()==null)
        {{-- Если у модуля есть тест, то обязательно тест должен быть повторен, либо вообще выводим только те модули, у которых нет теста --}}
        @php $section = App\Models\Section::find($module->pivot->section_id); @endphp
        @include('training.parts.module-item', [$module, $section])
        @endif
        @endforeach

    </div>

</div>
@endif
@endsection
