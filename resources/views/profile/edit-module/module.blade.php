@extends('layouts.profile-editor')

@section('class-body') edit-module @endsection

@section('content')

@include('profile.edit-module.parts.modal', $step_types)

<div class="margin-bottom-100">
    
    <div class="main-wrap">
        <section class="module-header-wrap">
            <div class="section-title">Раздел "{{$module->section->title}}"</div>
            <form class="form">
                <div class="module-header">
                    <div class="module-header-top">
                        <h2 class="title module-header-item__title">Модуль
                            <input type="text" name="title" class="module-header-item__title-input"
                                value="{{$module->title}}">
                        </h2>
                    </div>
                    <div class="module-header-inner">
                        <div class="module-header-item module-header-item__in-competence">

                            <div class="form-field">
                                <input type="checkbox" id="in-competences" checked>
                                <h2 class="title"><label for="in-competences">Есть входные компетенции</label></h2>
                            </div>
                            @include('profile.edit-module.parts.select-competences', ["module_competences"=> $module->competences_in])
                            
                        </div>

                        <div class="module-header-item">

                            <div class="form-field">
                                <input type="checkbox" id="out-competences" checked>
                                <h2 class="title"><label for="out-competences">Есть выходные компетенции</label></h2>
                            </div>

                            @include('profile.edit-module.parts.select-competences', ["module_competences"=> $module->competences_out])
                        </div>
                    </div>
                </div>
            </form>

        </section>
    </div>

    @include('profile.edit-module.parts.steps-block')
    @include('profile.edit-module.parts.step-editor')

    


</div>

@endsection
