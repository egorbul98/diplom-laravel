<header class="header">

    <div class="main-wrap">
        <div class="header-mobile">

            <div class="title">
            <h2><a href="{{route("home")}}">Онлайн курсы</a></h2>
            </div>
            <button class="btn-gamburger" type="button"><i class="fas fa-bars"></i></button>
        </div>
    </div>

    <div class="header-wrap">
        <div class="main-wrap">
            <div class="btn-close"><i class="fas fa-times"></i></div>
            <div class="header-top">
                <div class="left-block">
                    <div class="title">
                        <h2><a href="{{route("home")}}">Онлайн курсы</a></h2>
                    </div>
                </div>
                <div class="right-block">
                    <a class="tel" href="#">8 800 555 35 35</a>
                    <select name="language" id="language">
                        <option value="rus" selected>Русский</option>
                        <option value="en">Английский</option>
                    </select>
                    <div class="auth">
                        @auth
                        <div class="user">
                            <div class="user__name"><span class="lastname"></span><span class="firstname">{{$user->name}}</span></div>
                            <div class="icon"><i class="fas fa-chevron-down"></i></div>
                            <div class="drop-down shadow-light">
                            <div class="drop-down__item"><a href="{{route("profile")}}">Личный кабинет</a></div>
                                <div class="drop-down__item"><a href="{{route("logout")}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></div>
                            </div>
                        </div>
                        <a href="{{route("logout")}}" class="btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @else
                        <a href="{{route("login")}}" class="btn login">Войти</a>
                        <a href="{{route("register")}}" class="btn">Регистрация</a>
                        @endauth
                    </div>
                </div>
            </div>


            <div class="header-middle">
                <nav class="nav">
                    <div class="nav__item"><a href="{{route("course.index")}}">Каталог</a>
                        <div class="nav__item-drop drop">
                            @foreach ($categories as $category_item)
                                <div class="drop__item"><a href="{{route("category", $category_item->slug)}}">{{$category_item->title}}</a></div>
                             @endforeach
                        </div>
                    </div>
                    <div class="nav__item"><a href="#">Новости</a></div>
                    <div class="nav__item"><a href="#">О нас</a></div>
                </nav>
            <form class="form" action="{{route("course.search")}}" method="GET">
                    @csrf
                    <div class="form-field">
                        <input type="text" class="search" name="text" placeholder="Поиск по каталогу">
                        <button class="btn btn-search" type="submit">Искать</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</header>
