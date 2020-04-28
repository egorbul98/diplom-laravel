<section class="recommend-outer shadow">
  <div class="recommend">
      <div class="main-wrap">
          <div class="recommend-wrap">
              <h2 class="title">@lang('main.recommended_for_study')</h2>
              <div class="recommend-list">
                @foreach ($courses as $course)
                  @include('parts.recomend-item')
                @endforeach
              </div>
          </div>
      </div>
  </div>
</section>