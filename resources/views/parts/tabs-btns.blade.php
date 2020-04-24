<div class="tabs-btns">
    @foreach ($listLanguages as $lang)

    <button class="btn tab-btn @if ($locale == $lang || ($locale == null && $lang==" ru")) active @endif" type="button"
        data-tab="{{$lang}}">{{$lang}}</button>

    @endforeach
</div>
