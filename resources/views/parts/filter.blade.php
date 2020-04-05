<section class="filter">
  <div class="main-wrap">
  <form action="{{route("course.index")}}" method="GET">
      <div class="filter-wrapper shadow-light">
        <div class="filter__btns-wrap">
          <button type="button" class="btn filter-btn"><span class="icon"><i class="fas fa-sliders-h"></i></span>Фильтр</button>
          <div class="filter-inner">
            <a href="#" class="btn center">По новизне</a>
            <a href="#" class="btn center">По популярности</a>
          </div>
        </div>
        <form action="" class="form">
          <div class="drop-down">
            <div class="drop-down__inner">
              <div class="drop-down__item">
                <h3 class="title">Категории</h3>
                @foreach ($categories as $category)
                  <div class="form-field">
                    <input type="checkbox" name="category[{{$category->id}}]" id="category{{$category->id}}" @if (request()->has("category") && isset(request()->all()["category"][$category->id])) checked @endif>
                    <label for="category{{$category->id}}">{{$category->title}}</label>
                  </div>
                @endforeach
              </div>
  
              <div class="drop-down__item">
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
  
              <div class="drop-down__item">
                <h3 class="title">Рейтинг</h3>
  
                <div class="form-field">
                  <input type="radio" name="rating" id="rating1">
                  <label for="rating1">Рейтинг</label>
                </div>
              </div>
  
            </div>
            <div class="btns-wrap flex-wrap">
              <button type="submit" class="btn">Применить фильтр</button>
              <a href="{{route("course.index")}}" class="btn">Сбросить</a>
            </div>
          </div>
        </form>
      </div>
    </form>
  </div>
</section>