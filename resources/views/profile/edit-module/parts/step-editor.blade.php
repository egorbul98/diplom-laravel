@if (isset($step))

<div class="main-wrap">
    <form action="{{route("profile.module.step.update", [$module->id, $step->id])}}" method="POST">
        @csrf 
        <section class="step-editor">
            <div class="step-editor-header flex-b">
                <p class="step-editor-header__title"><span class="step-text">Шаг 11</span>|<span
                        class="step-type">{{$step->type->title}}</span></p>
                <div class="step-editor-header__wrap-btns">
                    <a href="{{route("profile.module.step.destroy", [$module->id, $section, $step->id])}}"
                        class="step-editor-header__btn-del btn"><span class="icon"><i
                                class="fas fa-times"></i></span>Удалить</a>
                    <button type="submit" class="step-editor-header__btn-save btn"><span class="icon m-r-8"><i class="fas fa-save"></i></span> Сохранить</button>
                </div>
            </div>
            <div class="step-editor-content">
                <form action="">
                    <textarea id="summernote" name="content">{{$step->content}}</textarea>
                </form>
            </div>
        </section>
    </form>

    
    @include('profile.edit-module.parts.step-answers')


</div>


@endif
