<div class="main-wrap">
  <div class="notifications ">
      @if (session("success"))
      <div class="notifications__item notifications__item--success"><span class="text">{{session("success")}}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
      @endif
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="notifications__item notifications__item--error"><span class="text">{{$error}}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
          @endforeach
      @endif
     
  </div>
</div>