<footer class="footer">
  <div class="main-wrap">
    <div class="footer-top">
      <div class="footer-item">
        <ul class="footer-list-link">
          <div class="footer__link"><a href="#">@lang('main.home')</a></div>
          <div class="footer__link"><a href="#">@lang('main.news')</a></div>
          <div class="footer__link"><a href="#">@lang('main.about')</a></div>
        </ul>
      </div>
      <div class="footer-item">
        <ul class="footer-list-link">
          <div class="footer__link"><a href="#">@lang('main.new_courses')</a></div>
          <div class="footer__link"><a href="#">@lang('main.popular_courses')</a></div>
          {{-- <div class="footer__link"><a href="#">Новости и статьи</a></div> --}}
        </ul>
      </div>
      <div class="footer-item">
        <div class="title">@lang('main.we_are_in_social_networks')</div>
        <ul class="social-list">
          <div class="social-list__item"><a href="#"><i class="fab fa-twitter-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-facebook-square"></i></a></div>
          <div class="social-list__item"><a href="#"><i class="fab fa-google-plus-square"></i></a></div>
        </ul>
      </div>
      <div class="footer-item">
        <form class="form" action="" method="GET">
          <div class="form-field">
            <input type="text" class="search" placeholder="Поиск по каталогу">
            <button class="btn btn-search" type="submit">@lang('main.search')</button>
          </div>
        </form>
     
        <div id="language" class="drop-down">

          @if ($locale==null)
          <a href="#" class="">@lang("main.ru")</a>
            @else 
            <a href="#" class="">@lang("main.$locale")</a>
          @endif
          
          <div class="language-inner">
              @foreach ($listLanguages as $lang)
              @if ($lang!=$locale)
              @if (!($locale==null && $lang=="ru"))
                <a href="{{route("set-locale", $lang)}}" class="lang">@lang("main.$lang")</a>
              @endif
              @endif
              @endforeach
              
          </div>
      </div>
      </div>
    </div>
    <div class="footer-bottom">
      <h1 class="title">@lang('main.online_courses')</h1>
      <div class="footer-item__years">© 2013 — 2020. @lang('main.online_courses')</div>
    </div>
  </div>
</footer>