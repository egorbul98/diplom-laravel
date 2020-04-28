<div class="select-wrap select-competences">
    <div class="select-custom">
        <div class="select-competences__left">
            <div class="list">
               
                @php $id_competences = []; @endphp
                @forelse ($module_competences as $item)
                {{-- @dump($item->id) --}}
                @php $id_competences[] = $item->__("title");@endphp
                @foreach ($listLanguages as $lang)
                    @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
                    <div class="tab 
                    @if ($locale == $lang || ($locale == null && $lang=="ru")) tab--active @endif " data-tab="{{$lang}}">
                    
                    <div class="select-competences-item">
                        <p class="text"><input type="text" value="{{$item["title$postfix"]}}" class="input-bg" readonly></p>
                    </div>
                    </div>
                @endforeach
                
                @empty
                <p>@lang('main.there_is_nothing')</p>
                @endforelse

            </div>
            <div class="select-competences__desc">@lang('main.competencies_included_in_the_module')</div>
        </div>
        
        <div class="select-competences__right">
            <div class="checkboxes">
                @foreach ($section->competences as $competence)
                <p class="flex-b">
                    <label>
                        <input type="checkbox" class="checkboxes__input" name="complex" value="{{$competence->id}}" @if (in_array($competence->__("title"), $id_competences)) data-checked="true" @endif>
                        <span class="check"></span>
                        <span class="text paragraph">{{$competence->__("title")}}</span>
                    </label>
                    <button class="btn-delete-competence btn-bg" type="button"
                        data-competence-id="{{$competence->id}}"><span class="icon"><i
                                class="fas fa-times"></i></span></button>
                </p>
                @endforeach

            </div>
            {{-- <div class="form-row input-add-competences form-field">
                <input type="text" class="input-control" placeholder="@lang('main.competency_name')">
                <div class="form-field__tooltip">
                    <span class="text">@lang('main.tooltips.characters_max', ["num"=> 128])</span>
                </div>
                
                <button class="btn btn-add" data-section-id="{{$section->id}}" type="button"><i
                        class="fas fa-plus"></i></button>
            </div> --}}
            <div class="select-competences__desc">@lang('main.choose_competencies')</div>
        </div>
    </div>
    
</div>
