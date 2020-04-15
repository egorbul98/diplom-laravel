
  <header class="lesson-header">
    <div class="lesson-header-inner">
      <button class="btn-gamburger" type="button"><i class="fas fa-bars"></i></button>
      <h2 class="lesson-header__logo"><a href="{{route("home")}}">Онлайн курсы</a></h2>
    </div>
    <div class="lesson-header__user">
    <div class="lesson-header__name"><span class="lastname">{{$user->lastname}}</span><span class="firstname">{{$user->name}}</span></div>
      <div class="icon"><i class="fas fa-chevron-down"></i></div>
      <div class="drop-down">
        <div class="drop-down__item"><a href="{{route("profile")}}">Личный кабинет</a></div>
        <form action="{{route("logout")}}" id="logout-form" method="POST" class="form">
          @csrf
          {{-- <div class="drop-down__item"><a href="{{route("logout")}}">Выйти</a></div> --}}
          <div class="drop-down__item"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></div>
        </form>
       
      </div>
    </div>
  </header>