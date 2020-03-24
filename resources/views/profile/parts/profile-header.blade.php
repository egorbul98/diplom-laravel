<div class="main-wrap">
  <section class="profile-header shadow-light">
    <div class="profile-header__img">
    <img src="{{asset("img/course.jpg")}}" alt=""><span class="icon"><i class="fas fa-user"></i></span>

      <form action="">
        <input type="file" id="edit-foto" style="visibility: hidden;">
        <label for="edit-foto" class="edit-foto"><i class="fas fa-edit"></i></label>
      </form>
    </div>
    <div class="profile-header__username">
      <h2 class="name">{{Auth::user()->name}} {{Auth::user()->lastname}}</h2>
      <div class="login">{{Auth::user()->email}}</div>
    </div>
  </section>
</div>
