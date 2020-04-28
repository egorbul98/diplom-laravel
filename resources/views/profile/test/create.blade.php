{{-- @extends('layouts.default') --}}
@extends('layouts.profile-editor')

@section('class-body') edit-test @endsection

@section('content')

<section class="new-test">
    <div class="main-wrap">
        @if ($test->exists)
        <h1 class="new-course__header">@lang('main.test_editing')</h1>
        @else
        <h1 class="new-course__header">@lang('main.create_a_new_test')</h1>
        @endif

        @if ($test->exists)
        <form class="form" action="{{route("profile.test.update", $test)}}" method="POST">
            @method("PUT")
            @else
            <form class="form" action="{{route("profile.test.store")}}" method="POST">
                @endif
                @csrf
                <div class="tabs-container">
                    @include('parts.tabs-btns')
                    @foreach ($listLanguages as $lang)
                    @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
                    <div class="tab  @if ($locale == $lang || ($locale == null && $lang==" ru")) tab--active
                        @endif " data-tab="{{$lang}}">

                        <div class="form-row">
                            <div class="form-row__left">
                                <p><label class="" for="title{{$postfix}}">@lang('main.title')<span
                                            class="required-input">*</span></label></p>
                            </div>
                            <div class="form-row__right form-field">
                                <input class="input-control" maxlength="64" id="title{{$postfix}}" name="title{{$postfix}}" type="text"
                                    value="{{old("title$postfix", $test["title$postfix"])}}">
                                <div class="form-field__tooltip">
                                    <span class="text">@lang('main.tooltips.characters_max', ["num"=> 64])</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-row__left">
                                <p><label class="" for="description{{$postfix}}">@lang('main.test_description')</label></p>
                            </div>
                            <div class="form-row__right form-field">
                            <textarea name="description{{$postfix}}" id="description{{$postfix}}"
                                    rows="10">{{old("description$postfix", $test["description$postfix"])}}</textarea>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    <div class="form-row">
                        <div class="form-row__left">
                            <p><label class="" for="description">@lang('main.number_of_active_questions_upon_presentation_of_the_test')</label></p>
                        </div>
                        <div class="form-row__right form-field">
                            <input type="number" name="count_questions" id="count_questions" min="1" max="40"
                                class="input-control" value="{{old("count_questions", $test->count_questions)}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-row__left">
                            <p><label class="" for="description">@lang('main.percentage_of_correctly_answered_questions_for_passing_the_test')</label></p>
                        </div>
                        <div class="form-row__right form-field">
                            <input type="number" name="percent_correct_answers" id="percent_correct_answers" min="1"
                                max="100" class="input-control"
                                value="{{old("percent_correct_answers", $test->percent_correct_answers)}}">
                        </div>
                    </div>

                    <div class="form-btns-wrap">
                        @if ($test->exists)
                        <button class="btn" type="submit"><span class="icon m-r-8"><i class="fas fa-save"></i></span>
                            @lang('main.save')</button>
                        @else
                        <button class="btn" type="submit">@lang('main.сreate')</button>
                        @endif

                        <a href="{{route("profile.test.index")}}" class="btn">@lang('main.to_the_list_of_tests')</a>
                    </div>
                </div>
            </form>

    </div>
</section>
@if ($test->exists)

<section class="test-sections margin-bottom-100" data-test-id="{{$test->id}}">
    <div class="main-wrap">
        <h2 class="new-course__header">@lang('main.questions_and_answer_options')</h2>


        <div class="test-sections-links">
            @for ($i = 0; $i < count($test->test_sections); $i++)
                <div class="test-sections-links__item">
                    <a href="{{$test->test_sections[$i]->id}}" class="test-sections-links__item-link"
                        data-test-section-id="{{$test->test_sections[$i]->id}}">{{($i + 1)}}</a>
                </div>
                @endfor

        </div>

        <div class="test-sections-content">
            <div class="margin-bottom-20">
                <h4 class="title">@lang('main.question_text')</h4>
                <div class="form-field">
                    <input type="text" class="input-control" id="test-section-title" name="title" value=""
                        maxlength="400" placeholder="Введите текст вопроса?">
                </div>
            </div>

            <div class="test-sections__img-wrap">
                <div class="form-field">
                    <label for="input-img" class="img-input">
                        <h4>@lang('main.choose_a_picture')</h4>
                    </label>
                    <input style="display: none" type="file" class="input-img" id="input-img" name="image"
                        multiple="multiple">
                </div>
                <div class="test-sections__img">
                    <img src="" alt="">
                </div>
            </div>

            <div class="answers-list">
                <p>@lang('main.correct')</p>
                <div class="answers-list-inner">

                    <div class="answer">
                        <div class="answer-inner">
                            <div class="check"><input type="checkbox" name="checkbox" value=""></div>
                            <input type="text" name="text" value="" class="input-control text">
                        </div>
                        <div class="answer-icon-wrap">
                            <div class="icon icon--delete"><i class="fas fa-times"></i></div>
                            <div class="icon icon--add"><i class="fas fa-plus"></i></div>
                        </div>
                    </div>



                </div>
            </div>

            <div class="form-btns-wrap">
                <button class="btn btn-save-test-section" type="button"><i class="fas fa-save"></i> @lang('main.save_question')</button>
                <button class="btn btn-del-test-section" type="button">@lang('main.delete_question')</button>
                <button class="btn btn-add-test-section" type="button" data-test-section-id="">@lang('main.add_next_question')</button>
            </div>
        </div>
    </div>
</section>

@endif


@endsection
