@extends('layouts.profile-editor')

@section('class-body') edit-module @endsection

@section('content')

@include('profile.edit-module.parts.modal', $step_types)

<div class="main-wrap margin-bottom-100">
    
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


    <div class="main-wrap">
        <section class="steps-block">
            <div class="steps-block-inner">
                <div class="step-list">
                    <div class="step-list__item"><a href="#"></a></div>
                    <div class="step-list__item step-list__item--active"><a href="#"></a></div>
                    <div class="step-list__item "><a href="#"><i class="fas fa-question"></i></a></div>
                    <div class="step-list__item"><a href="#"></a></div>
                    <div class="step-list__item"><a href="#"></a></div>
                    <div class="step-list__item step-list__item--add"><i class="fas fa-plus"></i></div>
                </div>
            </div>
        </section>
    </div>

    <div class="main-wrap">
        <section class="step-editor">
            <div class="step-editor-header flex-b">
                <div class="step-editor-header__title"><span class="step-text">Шаг 11</span>|<span
                        class="step-type">Текст</span></div>
                <button class="step-editor-header__btn-del btn"><span class="icon"><i
                            class="fas fa-times"></i></span>Удалить</button>
            </div>
            <div class="step-editor-content">
                <form action="">
                    <textarea id="summernote" name="content"></textarea>
                </form>
            </div>
        </section>
    </div>

    <div class="main-wrap">
        <section class="step-answer">
            <form action="" class="form">
                <div class="form-row">
                    <div class="form-row__left">
                        <p>Правильный ответ</p>
                    </div>
                    <div class="form-row__right">
                        <input type="text">
                        <div class="form-field__tooltip">
                            <span class="text">Не более 64 символов</span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-row__left">
                        <p>Допустимая погрешность</p>
                    </div>
                    <div class="form-row__right"><input type="text"></div>
                </div>
            </form>
        </section>
    </div>
</div>

@endsection
