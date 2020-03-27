<div class="modal modal--hidden">
  <div class="modal-window">
      <div class="modal-inner">
        <h2 class="title center">Выберите тип шага</h2>
          <div class="steps">
            @foreach ($step_types as $step)
            <div class="step">
             
                <form class="form" action="{{route("profile.module.step.store", [$module, $step->id])}}" method="POST">
                  @csrf
                  <h3>{{$step->title}}</h3>
                  <p >{{$step->description}}</p>
                  <a href="" class="overlay"></a>
              </form>
            </div>
            @endforeach
          </div>
        
        <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
      </div>
  </div>
</div>