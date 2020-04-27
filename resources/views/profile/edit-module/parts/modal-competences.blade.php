<div class="modal modal--hidden modal-competences">
    <div class="modal-window">
        <div class="modal-inner">
          <div class="tabs-container">
            <form class="form">
                <h2 class="title center">@lang('main.list_of_competencies_in_this_section')</h2>
                <div class="flex-b header-btns">
                    <button class="btn btn-save-competences" type="button">@lang('main.save')</button>
                    @include('parts.tabs-btns')
                </div>
                <div>
                  @foreach ($listLanguages as $lang)
                  @php $postfix = ($lang=="ru") ? '' : "_$lang" @endphp
                  <div class="tab 
                    @if ($locale == $lang || ($locale == null && $lang==" ru")) tab--active @endif " data-tab="{{$lang}}">
                      <div class="competences-list">
                          @foreach ($section->competences as $competence)
                          <div class="flex-b competences-list__item" data-competence-id="{{$competence->id}}">
                              <input type="text" class="competence input-bg input-control input-title"
                                  value="{{$competence["title$postfix"]}}" data-section-id="{{$section->id}}" data-competence-id="{{$competence->id}}">
                              <button class="btn-delete-competence btn-bg" type="button"
                                  data-competence-id="{{$competence->id}}"><span class="icon"><i
                                          class="fas fa-times"></i></span></button>
                          </div>
                          @endforeach
                      </div>
                      <div class="input-add-competences form-field">
                          <input type="text" class="input-control" placeholder="Название компетенции">
                          <button class="btn btn-add" data-section-id="{{$section->id}}" type="button"><i class="fas fa-plus"></i></button>
                      </div>
                  </div>
                  @endforeach
                </div>
                <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
            </form>
        </div>
      </div>
    </div>
</div>
