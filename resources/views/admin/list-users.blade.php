@extends('layouts.default')

@section('class-body') admin @endsection

@section('content')

@include('admin.parts.modal-roles')

<div class="main-wrap">
  <h2 class="margin-top-20">@lang('main.admin_panel')</h2>
  <section class="profile-wrapper">
    
    @include('admin.parts.sidebar')

    <main class="profile-content">

      <h3 class="title">Все пользователи</h3>
      <form class="form-filter-users form" action="" method="GET">
        <div class="form-field">
          <input type="text" class="input-control" name="text" placeholder="Поиск по имени" value="@if (request()->has("text")){{request()->all()["text"]}}@endif">
        </div>
        <div class="form-filter-users__inner">
          <div class="form-field form-checkbox">
            @foreach ($roles as $role)
              <div class="checkbox-item">
                <input type="checkbox" name="roles[]" id="roles-{{$role->id}}" value="{{$role->id}}" @if (request()->has("roles") && in_array($role->id, request()->all()["roles"])) checked @endif>
                <p class="label"><span class="check"></span><label for="roles-{{$role->id}}">{{$role->__("title")}}</label></p>
              </div>
            @endforeach
            
          </div>
          <button class="btn btn-filter" type="submit">Искать</button>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>Имя</th>
              <th>Роли</th>
              <th>Дата регистрации</th>
              <th>Назначить роль</th>
            </tr>
          </thead>
          <tbody>
          
            @foreach ($users as $user_item)
            @php  $timeReg = Carbon\Carbon::parse($user_item->created_at)->format("d.m.Y h:i"); @endphp
            <tr>
              <td class="table-img"><img src="{{asset("storage/".$user_item->image)}}" alt=""></td>
              <td class="profile-content-table-course__title">{{$user_item->fullname()}}</td>
              {{-- <td class="profile-content-table-course__title">{{$user_item->roles}}</td> --}}
              <td class="profile-content-table-course__title">
                @php $count_roles = $user_item->roles->count();  @endphp
               
                @foreach ($user_item->roles as $user_role)
                @if($count_roles>1 && $user_role->id==1)
                 
                @else 
                  <span class="user_role">{{$user_role->__("title")}}</span>
                @endif
               
                @endforeach
                
              </td>
              {{-- <td class="profile-content-table-course__title">{{$user_item->created_at->format("d.m.Y")}}</td> --}}
              <td>{{$timeReg}}</td>
              <td class="table-btn"><a href="#" class="btn btn-add-role" data-user-id="{{$user_item->id}}">Назначить</a></td>
            </tr>
            @endforeach
            
          
          </tbody>
        </table>
      </div>

      <section class="paginate center">
        {{$users->links()}}
      </section>
    </main>
  </section>
</div>

@endsection
