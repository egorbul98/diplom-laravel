@extends('layouts.default')

@section('class-body') profile edit-test @endsection

@section('content')

@include('profile.parts.profile-header')

<div class="main-wrap">
  <section class="profile-wrapper">
    
    @include('profile.parts.sidebar')

    <main class="profile-content">
   
        <h3 class="title">@lang('main.your_created_tests')</h3>
        <a href="{{route("profile.test.create")}}" class="btn btn-add"><span class="icon"><i class="fas fa-plus"></i></span> @lang('main.сreate')</a>
      
      <div class="test-list">

    

      @foreach ($tests as $test)
        <div class="test-item shadow-light" data-test-id="{{$test->id}}">
            <div class="test-item-inner">
                <div class="left flex-b">
                    <div class="test-item__title">{{$test->title}}</div>
                </div>
                  <div class="icon-arrow"><i class="fas fa-chevron-left"></i></div>
                  <div class="test-item-edit">
                    <a href="{{route("profile.test.edit", $test)}}"><span class="icon"><i class="fas fa-edit"></i></span></a>
                    <a href="{{route("profile.test.delete", $test->id)}}"><span class="icon"><i class="fas fa-trash-alt"></i></span></a>
                  </div>
            </div>
            <div class="test-item-models">
              <div class="test-item-models__item">
                <h4 class="test-item-models__text">
                  @lang('main.modules_to_which_this_test_is_attached')
                </h4>
                <div>
                <button class="btn btn-attach-test-module" type="button" data-test-id="{{$test->id}}">@lang('main.attach_test_to_module')</button>
                  
                </div>
              </div>
                <div class="test-item-models__inner">
                  @foreach ( $test->modules as $module)
                  <div class="test-item-models__item">
                    <p class="test-item-models__text">
                      <a href="{{route("profile.module.edit", $module->id)}}">{{$module->title}}</a>
                    </p>
                  <button class="btn btn-detach-module-test" type="button" data-module-id="{{$module->id}}">@lang('main.detach')</button>
                  </div>
                  @endforeach
                </div>
            </div>
            
        </div>
        @endforeach
    </div>

    <section class="paginate center">
      {{$tests->links()}}
    </section>

    </main>
  </section>
</div>


<div class="modal modal--hidden modal-modules">
  <div class="modal-window">
      <div class="modal-inner">
        <h2 class="title center">@lang('main.select_a_module_to_attach_to_the_test')</h2>
        <div class="form-field">
          <input type="text" class="search" placeholder="Найти модуль по названию">
          <button class="btn btn-search" type="submit">@lang('main.search')</button>
        </div>

        <div class="modal-list-modules">
          <p>@lang('main.no_modules_yet')</p>
        </div>

        <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
      </div>
  </div>
</div>

@endsection
