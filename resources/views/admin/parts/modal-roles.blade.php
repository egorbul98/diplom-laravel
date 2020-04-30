<div class="modal modal--hidden modal-roles">
{{-- <div class="modal hidden modal-roles"> --}}
  <div class="modal-window">
      <div class="modal-inner">
        <h2 class="title center"><span class="username" data-user-id="">Пользователь</span><div>@lang('main.assign_roles_to_user') </div></h2>
       
          <form class="form form-roles" action="" type="POST">
            <input type="hidden" class="user_id" name="user_id" value="">
            <div class="form-field form-checkbox">
              @foreach ($roles as $role)
              
                @if($role->id!=1)
                <div class="checkbox-item">
                  <input type="checkbox" name="roles[]" id="roles{{$role->id}}" value="{{$role->id}}" @if (request()->has("roles") && in_array($role->id, request()->all()["roles"])) checked @endif>
                  <p class="label"><span class="check"></span><label for="roles{{$role->id}}">{{$role->__("title")}}</label></p>
                </div>
                @endif
                
              @endforeach
            </div>
            <button class="btn btn-user-roles-save" type="button">@lang('main.save')</button>
          </form>
        
        <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
        
      </div>
  </div>
</div>