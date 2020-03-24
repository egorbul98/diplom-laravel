{{-- @extends('layouts.app') --}}
@extends('layouts.default')

@section('class-body')
list
@endsection

@section('content')

<section class="recommend-outer shadow">
  <div class="recommend">
      <div class="main-wrap">
          <div class="recommend-wrap">
              <h2 class="title">Рекомендуем к изучению</h2>
              <div class="recommend-list">
                @foreach ($courses as $course)
                  @include('parts.recomend-item', $course)
                @endforeach
              </div>
          </div>
      </div>
  </div>
</section>


<section class="filter">
  <div class="main-wrap">
    <div class="filter-wrapper shadow-light">
      <div class="filter__btns-wrap">
        <button class="btn filter-btn"><span class="icon"><i class="fas fa-sliders-h"></i></span>Фильтр</button>
        <div class="filter-inner">
          <a href="#" class="btn center">По новизне</a>
          <a href="#" class="btn center">По популярности</a>
        </div>
      </div>
      <form action="" class="form">
        <div class="drop-down">
          <div class="drop-down__inner">
            <div class="drop-down__item">
              <h3 class="title">Категория</h3>
              <div class="form-field">
                <input type="checkbox" name="category" id="category1">
                <label for="category1">Программирование</label>
              </div>
              <div class="form-field">
                <input type="checkbox" name="category" id="category2">
                <label for="category2">Дизайн</label>
              </div>
              <div class="form-field">
                <input type="checkbox" name="category" id="category3">
                <label for="category2">Категория</label>
              </div>
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
          <button type="submit" class="btn">Применить фильтр</button>
        </div>
      </form>
    </div>
  </div>
</section>


<section class="courses">
  <div class="main-wrap">
      <div class="courses-list">
          @foreach ($courses as $course)
              @include('parts.course-item', $course)
          @endforeach
      </div>
</section>

<div class="main-wrap">
  <section class="paginate center">
    {{$courses->links()}}
  </section>
</div>


</section>
@endsection
