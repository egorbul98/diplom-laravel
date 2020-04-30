@extends('layouts.profile-editor')

@section('class-body') edit-module @endsection

@section('content')

@include('profile.edit-module.parts.modal', $step_types)
@isset($section->id)
@include('profile.edit-module.parts.modal-competences')
@endisset

<div class="margin-bottom-100">
    <div class="tabs-container">
        <div class="main-wrap">

            <section class="module-header-wrap">
                
                @isset($section->id)

                <a href="{{route("profile.course.sections.edit", $section->course->id)}}">@lang('main.come_back')</a>
                <div class="section-title">@lang('main.section') "{{$section->__("title")}}"</div>

                @else
                <div><a href="{{route("profile.module.index")}}">@lang('main.back_to_the_list_of_modules')</a></div> <br>
                
                @endisset

                @include('parts.tabs-btns') 
                <form class="form">
                    <div class="module-header" data-module-id="{{$module->id}}">
                        <div class="module-header-top">
                            <h2 class="title module-header-item__title">{{Lang::choice('main.secitions_modules', 1, [], ($locale==null)? "ru" : $locale)}}
                                @foreach ($listLanguages as $lang)
                                    @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
                                    <div class="tab 
                                    @if ($locale == $lang || ($locale == null && $lang=="ru")) tab--active @endif " data-tab="{{$lang}}">
                                    
                                    <input type="text" name="title{{$postfix}}"  class="module-header-item__title-input"
                                            value="{{$module["title$postfix"]}}">
                                    </div>
                                @endforeach
                            </h2>
                            @isset($section->id)
                                <button type="button" class="open-modal-competences btn">@lang('main.list_of_competencies_in_this_section')</button> 
                            @endisset
                            
                        </div>
                        
                        @isset($section->id)

                        <div class="module-header-inner">
                            <div class="module-header-item module-header-item__in-competence">

                                <div class="form-field">
                                    <input type="checkbox" id="in-competences" @if(isset($module->competences_in[0]))
                                    checked @endif >
                                    <h2 class="title"><label for="in-competences">@lang('main.there_are_input_competencies')</label></h2>
                                </div>
                                @include('profile.edit-module.parts.select-competences', ["module_competences"=>
                                $module->competences_in])

                            </div>

                            <div class="module-header-item module-header-item__out-competence">

                                <div class="form-field">
                                    <input type="checkbox" id="out-competences" @if(isset($module->competences_out[0]))
                                    checked @endif>
                                    <h2 class="title"><label for="out-competences">@lang('main.there_are_output_competencies')</label>
                                    </h2>
                                </div>

                                @include('profile.edit-module.parts.select-competences', ["module_competences"=>
                                $module->competences_out])
                            </div>
                        </div>

                        @endisset

                        <div class="wrap-btn ">
                            <button class="btn btn-save-module" type="button"><span class="icon m-r-8"><i
                                        class="fas fa-save"></i></span> @lang('main.save_module_data')</button>
                            <button class="btn btn-attach-test" id="btn-attach-test" data-module-id="{{$module->id}}"
                                type="button">@lang('main.add_test_to_module')</button>
                            @isset($module->test)
                            <p class="current-test">@lang('main.current_test'): <a
                                    href="{{route("profile.test.edit",$module->test->id)}}">{{$module->test->__("title")}}</a>
                            </p>
                            @endisset

                        </div>
                    </div>
                </form>

            </section>

        </div>

        @include('profile.edit-module.parts.steps-block')
        @include('profile.edit-module.parts.step-editor')

    </div>
</div>


<div class="modal modal--hidden modal-modules">
    <div class="modal-window">
        <div class="modal-inner">
            <h2 class="title center">@lang('main.select_the_test_you_want_to_add_or') <a
                    href="{{route("profile.test.create")}}">@lang('main.create_new')</a></h2>
            <div class="form-field">
                <input type="text" class="search" placeholder="@lang('main.find_a_test_by_name')">
                <button class="btn btn-search" type="submit">@lang('main.search')</button>
            </div>
           
            <div class="modal-list-modules">
                <p>@lang('main.no_tests_yet')</p>
            </div>

            <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
        </div>
    </div>
</div>
{{-- @include('profile.parts.footer-editor', [$body = "module"]) --}}
@endsection
