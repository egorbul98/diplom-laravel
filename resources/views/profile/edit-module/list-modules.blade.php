@extends('layouts.default')

@section('class-body') profile @endsection

@section('content')

@include('profile.parts.profile-header')

<div class="main-wrap">
  <section class="profile-wrapper">
    
    @include('profile.parts.sidebar')

    <main class="profile-content">
      <h3 class="title">Ваши созданные модули</h3>
    {{-- <a href="{{route("profile.course.create")}}" class="btn btn-add"><span class="icon"><i class="fas fa-plus"></i></span> Создать</a>
     --}}
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Название</th>
            <th>Количество шагов</th>
            <th>Дата изменения</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($modules as $module)
          <tr>
            <td class="profile-content-table-course__title">{{$module->title}}</td>
            <td class="profile-content-table-course__title">{{$module->steps->count()}}</td>
            <td>{{$module->updated_at}}</td>
            <td class="table-btn"><a href="{{route("profile.module.edit", $module->id)}}" class="btn">Редактировать</a></td>
            <td class="table-btn"><a href="#" class="btn">Удалить</a></td>
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
    <div class="main-wrap">
      <section class="paginate center">
        {{$modules->links()}}
      </section>
    </div>

    </main>
  </section>
</div>
    
    




@endsection
