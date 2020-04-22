@extends('layouts.training-layout')
@section('class-body') @endsection

@section('content')
@if(isset($step) && !empty($step) && $step->exists())

<div class="lesson-content__header">
  <h1 class="title">{{$module->title}}</h1>
  <h1 class="step">{{$step_num+1}}/{{$module->steps->count()}}</h1>
</div>

<div class="module-body">
  {!!$step->content!!}
</div>

<div class="wrap-btn-module-nav">
  @if ($step_num!=0)
    <a href="{{route("training.module", [$course->id, $section->id, $module->id, ($step_num-1)])}}" class="btn btn-next-step">Предыдущий шаг</a>
  @endif
  
  @if ($step->progress_users_for_user(Auth::user()->id)->exists())
    @if ($step_num==$module->steps->count()-1 )
    <form action="{{route("training.module-completed")}}" class="form" method="POST">
      @csrf
      <input type="hidden" name="course_id" value="{{$course->id}}">
      <input type="hidden" name="module_id" value="{{$module->id}}">
      <input type="hidden" name="section_id" value="{{$section->id}}">
      
      @if (isset($module->test) && ($module->test_completed->where("id", $module->test_id)->first()==null || $module->test_completed->first()->pivot->repeated == 1))
      {{-- Если у модуля есть тест и этот тест либо вообще не проходился ни разу, либо этот тест проходился при повторении модуля (при забывании) и был не пройден --}}
      <a href="{{route("training.test", [$course->id, $section->id, $module->id, $step_num])}}" class="btn btn--green  btn-next-step">Пройти тест</a>
      @else
        <button type="submit" class="btn btn--green btn-next-step">Завершить</button>
      @endif
        {{-- <button type="submit" class="btn btn--green btn-next-step">Завершить</button> --}}

    </form>
      
    @else 
    <a href="{{route("training.module", [$course->id, $section->id, $module->id, ($step_num+1)])}}" class="btn btn-next-step">Следующий шаг</a>
    @endif
  @endif
</div>  

@if ($step->type->id == 2 || $step->type->id == 3)
  <div class="module-answer">
    <p class="module-answer__condition">Напишите ответ</p>
    <form action="{{route("training.step-check-answer", [$course->id, $section->id, $module->id, $step->id])}}" class="form" method="POST">
      @csrf
      <div class="form-field">
        @if ($step->type->id == 2)
          <textarea name="answerString" class=" module-answer__input" placeholder="Введите ответ"></textarea>
        @else
        <div class="form-row">
          <div class="form-row__right form-field ">
              <input type="text" name="answerNum" class=" num-only   value">
          </div>
        </div>
        @endif
        
      </div>
        <button type="submit" class="btn">Ответить</button>
    </form>
  </div>
@endif





@endif

@endsection
