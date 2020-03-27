<div class="main-wrap">
  <section class="steps-block">
      <div class="steps-block-inner">
          <div class="wrap-step-list">
            <div class="step-list">
              @foreach ($module->steps as $m_step)
                @php
                    if($m_step->id == $step->id){
                      $active = 'step-list__item--active';
                    }else{
                      $active = '';
                    }
                @endphp
                
                @if ($m_step->step_type_id == 2 || $m_step->step_type_id == 3)
                  <div class="step-list__item {{$active}}"><a href="{{route("profile.course.module.edit", [$module, $m_step->id])}}"><i class="fas fa-question"></i></a></div>
                @else
               
                <div class="step-list__item  {{$active}} "><a href="{{route("profile.course.module.edit", [$module, $m_step->id])}}"></a></div>
                @endif
                
                    
              @endforeach
              {{-- <div class="step-list__item"><a href="#"></a></div>
              <div class="step-list__item step-list__item--active"><a href="#"></a></div>
              <div class="step-list__item "><a href="#"><i class="fas fa-question"></i></a></div>
              <div class="step-list__item"><a href="#"></a></div>
              <div class="step-list__item"><a href="#"></a></div>
              <div class="step-list__item step-list__item--add"><i class="fas fa-plus"></i></div> --}}
            </div>
              
              @if (isset($step))
              <div class="step-list__item step-list__item--add" id="btn-add-step"><p><i class="fas fa-plus"></i></p></div>
                @else
                <button class="btn" id="btn-add-step"><i class="fas fa-plus"></i> Создать шаг</button>
              @endif
              
              
          </div>
      </div>
  </section>
</div>
