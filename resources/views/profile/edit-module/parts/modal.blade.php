<div class="modal modal--hidden modal-step-types">
  <div class="modal-window">
      <div class="modal-inner">
        <h2 class="title center">@lang('main.choose_step_type')</h2>
          <div class="steps">
            @foreach ($step_types as $step)
            <div class="step">
              @isset($section->id)
                <form class="form" action="{{route("profile.module.step.store", [$module, $step->id, $section])}}" method="POST">
              @else 
                <form class="form" action="{{route("profile.module.step.store", [$module, $step->id])}}" method="POST">
              @endisset
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