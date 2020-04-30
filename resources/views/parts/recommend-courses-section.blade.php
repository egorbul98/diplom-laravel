<section class="recommend-outer shadow">
  <div class="recommend">
      <div class="main-wrap">
          <div class="recommend-wrap">
              <h1 class="title">@lang('main.recommended_for_study')</h1>
              <div class="recommend-list">
                @foreach ($recommended_courses as $course)
                  @include('parts.recomend-item')
                @endforeach
              </div>
          </div>
      </div>
  </div>
</section>