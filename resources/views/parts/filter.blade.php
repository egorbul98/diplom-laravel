<section class="filter">
  <div class="main-wrap">
  <form action="{{route("course.index")}}" method="GET">
      <div class="filter-wrapper shadow-light">
        <div class="filter__btns-wrap">
          <button type="button" class="btn filter-btn"><span class="icon"><i class="fas fa-sliders-h"></i></span> @lang('main.filter.filter') </button>
          <div class="filter-inner">
            {{-- @dd(request()->getQueryString()) --}}
            <input type="radio" id="sort-new" name="sort" style="display: none" @if (request()->has("sort") && request()->all()["sort"]=="new") checked @endif value="new">
            <label for="sort-new" class="btn">Сначала новые</label>
            <input type="radio" id="sort-old" name="sort" style="display: none"  @if (request()->has("sort") && request()->all()["sort"]=="old") checked @endif value="old">
            <label for="sort-old" class="btn">Сначала старые</label>
          </div>
        </div>
        <form action="" class="form">
          <div class="drop-down">
            <div class="drop-down__inner">
              <div class="drop-down__item">
                <h3 class="title">@lang('main.categories')</h3>
                
                @foreach ($categories as $category)
                  <div class="form-field">
                    <input type="checkbox" name="category[{{$category->id}}]" id="category{{$category->id}}" @if (request()->has("category") && isset(request()->all()["category"][$category->id])) checked @endif>
                    <label for="category{{$category->id}}">{{$category->__("title")}}</label>
                  </div>
                @endforeach
              </div>
  
              {{-- <div class="drop-down__item">
                <h3 class="title">Язык</h3>
                <div class="form-field">
                  <input type="checkbox" name="language" id="language1">
                  <label for="language1">Русский</label>
                </div>
                <div class="form-field">
                  <input type="checkbox" name="language" id="language2">
                  <label for="language2">Английский</label>
                </div>
              </div>
   --}}
              <div class="drop-down__item">
                <h3 class="title">@lang('main.filter.rating')</h3>
                  @for ($i = 4; $i > 0; $i--)
                  <div class="form-field">
                  <input type="radio" name="rating" id="rating-{{$i}}" value="{{$i}}" @if (request()->has("rating") && request()->all()["rating"]==$i) checked @endif>
                    <label for="rating-{{$i}}">@lang('main.filter.rating') > {{$i}}</label>
                  </div>
                  @endfor
                  <div class="form-field">
                  <input type="radio" name="rating" id="rating" value="all" @if (request()->has("rating") && request()->all()["rating"]=="all") checked @endif>
                  <label for="rating">@lang('main.all')</label>
                </div>
              </div>
  
            </div>
            <div class="btns-wrap flex-wrap">
              <button type="submit" class="btn">@lang('main.filter.apply_filter')</button>
              <a href="{{route("course.index")}}" class="btn">@lang('main.reset')</a>
            </div>
          </div>
        </form>
      </div>
    </form>
  </div>
</section>