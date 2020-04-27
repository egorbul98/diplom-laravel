@if (isset($step))

<div class="main-wrap">
    <form action="{{route("profile.module.step.update", [$module->id, $step->id])}}" method="POST">
        @csrf 
        <section class="step-editor">
            <div class="step-editor-header flex-b">
                <p class="step-editor-header__title"><span class="step-text">Шаг 11</span>|<span
                        class="step-type">{{$step->type->title}}</span></p>
                <div class="step-editor-header__wrap-btns">
                    @isset($section->id)
                        
                    <a href="{{route("profile.module.step.destroy", [$module->id, $step->id, $section])}}"
                        class="step-editor-header__btn-del btn"><span class="icon"><i
                                class="fas fa-times"></i></span>@lang('main.delete')</a>

                    @else
                            
                    <a href="{{route("profile.module.step.destroy", [$module->id,$step->id])}}"
                        class="step-editor-header__btn-del btn"><span class="icon"><i
                                class="fas fa-times"></i></span>@lang('main.delete')</a>

                    @endisset
                   


                    <button type="submit" class="step-editor-header__btn-save btn"><span class="icon m-r-8"><i class="fas fa-save"></i></span> @lang('main.save')</button>
                </div>
            </div>
            <div class="step-editor-content">
                <form action="">
                   
                    @foreach ($listLanguages as $lang)
                    @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
                        <div class="tab @if ($locale == $lang || ($locale == null && $lang=="ru")) tab--active @endif " data-tab="{{$lang}}">
                            <textarea class="summernote" id="summernote" name="content{{$postfix}}"> 
                               {{ $step['content'.$postfix]}}
                        </textarea>
                        </div>
                    @endforeach
                    
                    
                </form>
            </div>
        </section>
    </form>

    
    @include('profile.edit-module.parts.step-answers')


</div>


@endif
