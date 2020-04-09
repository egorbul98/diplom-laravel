@extends('layouts.profile-editor')

@section('class-body') edit-module @endsection

@section('content')

@include('profile.edit-module.parts.modal', $step_types)


<div class="margin-bottom-100">
    <div class="main-wrap">
        <section class="module-header-wrap">

        @isset($section->id)

            <a href="{{route("profile.course.sections.edit", $section->course->id)}}">Вернуться назад</a> 
            <div class="section-title">Раздел "{{$section->title}}"</div>

        @else 

        <div><a href="{{route("profile.module.index")}}">Вернуться к списку модулей</a> </div>
        <br>

        @endisset
            
            <form class="form">
            <div class="module-header" data-module-id="{{$module->id}}">
                    <div class="module-header-top">
                        <h2 class="title module-header-item__title">Модуль
                            <input type="text" name="title" class="module-header-item__title-input"
                                value="{{$module->title}}">
                        </h2>
                    </div>
                    @isset($section->id)

                        <div class="module-header-inner">
                            <div class="module-header-item module-header-item__in-competence">

                                <div class="form-field">
                                    <input type="checkbox" id="in-competences"  @if(isset($module->competences_in[0])) checked @endif >
                                    <h2 class="title"><label for="in-competences">Есть входные компетенции</label></h2>
                                </div>
                                @include('profile.edit-module.parts.select-competences', ["module_competences"=> $module->competences_in])
                                
                            </div>

                            <div class="module-header-item module-header-item__out-competence">
                            
                                <div class="form-field">
                                    <input type="checkbox" id="out-competences" @if(isset($module->competences_out[0])) checked @endif>
                                    <h2 class="title"><label for="out-competences">Есть выходные компетенции</label></h2>
                                </div>

                                @include('profile.edit-module.parts.select-competences', ["module_competences"=> $module->competences_out])
                            </div>
                        </div>
            
                    @endisset
                    
                    <div class="wrap-btn ">
                        <button class="btn btn-save-module" type="button"><span class="icon m-r-8"><i class="fas fa-save"></i></span> Сохранить данные модуля</button>
                        <button class="btn btn-attach-test" id="btn-attach-test" data-module-id="{{$module->id}}" type="button">Добавить тест к модулю</button>
                        @isset($module->test)
                        <p class="current-test">Текущий тест: <a href="{{route("profile.test.edit",$module->test->id)}}">{{$module->test->title}}</a></p>
                        @endisset
                        
                    </div>
                </div>
            </form>

        </section>
    </div>

    @include('profile.edit-module.parts.steps-block')
    @include('profile.edit-module.parts.step-editor')

    
</div>


<div class="modal modal--hidden modal-modules">
    <div class="modal-window">
        <div class="modal-inner">
          <h2 class="title center">Выберите тест, который хотите добавить или <a href="{{route("profile.test.create")}}">создайте новый</a></h2>
          <div class="form-field">
            <input type="text" class="search" placeholder="Найти тест по названию">
            <button class="btn btn-search" type="submit">Искать</button>
          </div>
  
          <div class="modal-list-modules">
            <p>Тестов пока нет</p>
          </div>
  
          <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
        </div>
    </div>
  </div>
{{-- @include('profile.parts.footer-editor', [$body = "module"]) --}}
@endsection
