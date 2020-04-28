@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')
  <div class="lesson-content__header">
    <h1 class="title">Сетевые технологии. Модуль</h1>
    <p class="center">Для завершения данного модуля, пройдите тест</p>
  </div>

  <form action="{{route("training.test-completed")}}" class="form" method="POST">
    @csrf
    <input type="hidden" name="test_id" value="{{$test->id}}">
    <input type="hidden" name="course_id" value="{{$course->id}}">
    <input type="hidden" name="module_id" value="{{$module->id}}">
    <input type="hidden" name="section_id" value="{{$section->id}}">
    <input type="hidden" name="step_num" value="{{$step_num}}">
    @php  
            if($test->count_questions<=count($test->test_sections)){
              $countQuestion = $test->count_questions; 
            }else{
              $countQuestion = count($test->test_sections); 
            }
            $test_sections = $test->test_sections->random($countQuestion);
            
      @endphp
    <input type="hidden" name="test_questions_count[{{$test->id}}][]" value="{{$countQuestion}}">
    <div class="module-test">
      
      @for ($i = 0; $i < $countQuestion; $i++)
      <div class="module-test__item">
        <div class="module-test__img"><img src="{{asset("storage/".$test_sections[$i]->image)}}" alt=""></div>
        <p class="module-test__text paragraph">{{$i+1}}. {{$test_sections[$i]->title}}</p>
        <div class="module-test__answers">
          @foreach ($test_sections[$i]->answers as $answer)
            {{-- <div class="form-field">
              <input type="radio" name="a1" id="a1" value="1">
              <p class=""><label for="a1">То самое</label></p>
            </div> --}}
            <div class="form-field form-checkbox">
              <input type="checkbox" name="answer[{{$test_sections[$i]->id}}][]" id="answer{{$answer->id}}" value="{{$answer->id}}">
              <p class="label"><span class="check"></span><label for="answer{{$answer->id}}">{{$answer->value}}</label></p>
            </div>
            @endforeach

        </div>
      </div>
      @endfor
     
    </div>
    <button type="submit" class="btn btn--green">@lang('main.complete')</button>
  </form>




@endsection
