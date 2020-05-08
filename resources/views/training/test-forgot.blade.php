@extends('layouts.training-layout')
@section('class-body') @endsection


@section('content')
  <div class="lesson-content__header">
    <h1 class="title">Пройдите тест</h1>
    <p class="center"></p>
  </div>

  <form action="{{route("training.forgot-test-completed")}}" class="form" method="POST">
    @csrf
    <input type="hidden" name="course_id" value="{{$course->id}}">
    @php $tests = $test_sections->groupBy("test_id") @endphp
      @foreach ($tests as $test_id=>$test)
        <input type="hidden" name="test_questions_count[{{$test_id}}][]" value="{{count($test)}}">
      @endforeach
    <div class="module-test">
      @for ($i = 0; $i < count($test_sections); $i++)
      <div class="module-test__item">
        <div class="module-test__img"><img src="{{asset("storage/".$test_sections[$i]->image)}}" alt=""></div>
        <p class="module-test__text paragraph">{{$i+1}}. {{$test_sections[$i]->__("title")}}</p>
        <div class="module-test__answers">
          @foreach ($test_sections[$i]->answers as $answer)
          
            {{-- <div class="form-field">
              <input type="radio" name="a1" id="a1" value="1">
              <p class=""><label for="a1">То самое</label></p>
            </div> --}}
            <div class="form-field form-checkbox">
              <input type="checkbox" name="{{$test_sections[$i]->id}}[]" id="answer{{$answer->id}}" value="{{$answer->id}}">
              <p class="label"><span class="check"></span><label for="answer{{$answer->id}}">{{$answer->__("value")}}</label></p>
            </div>
            @endforeach

        </div>
      </div>
      @endfor
     
    </div>
    <button type="submit" class="btn btn--green">@lang('main.complete')</button>
  </form>




@endsection
