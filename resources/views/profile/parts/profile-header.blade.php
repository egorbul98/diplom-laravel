<div class="main-wrap">
  <section class="profile-header shadow-light">
    <div class="profile-header__img">
    <img src="{{asset('/storage/'.$user->image)}}" alt=""><span class="icon"><i class="fas fa-user"></i></span>

      <form action="">
        {{-- <input type="file" id="edit-foto" style="visibility: hidden;"> --}}
      <a href="{{route("profile.settings")}}" for="edit-foto" class="edit-foto"><i class="fas fa-edit"></i></a>
      </form>
    </div>
    <div class="profile-header__username">
      <h2 class="name">{{$user->name}} {{$user->lastname}}</h2>
      <div class="login">{{$user->email}}</div>
    </div>
  </section>
</div>
