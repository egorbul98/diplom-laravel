@extends('layouts.default')

@section('class-body') profile edit-user @endsection

@section('content')

@include('profile.parts.profile-header')

<div class="main-wrap">
    <section class="profile-wrapper">

        @include('profile.parts.sidebar')

        <main class="profile-content">
            <h3 class="title margin-bottom-20">@lang('main.settings')</h3>

            <form class="form" action="{{route("profile.saveSettings")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-row__left">
                        <p><label class="" for="name">@lang('main.your_name')<span class="required-input">*</span></label></p>
                    </div>
                    <div class="form-row__right form-field">
                        <input type="text" name="name" class="input-control" value="{{$user->name}}">
                        <div class="form-field__tooltip">
                            <span class="text">@lang('main.tooltips.characters_max', ["num"=> 32])</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-row__left">
                        <p><label class="" for="lastname">@lang('main.your_last_name')<span class="required-input">*</span></label></p>
                    </div>
                    <div class="form-row__right form-field">
                        <input type="text" name="lastname" class="input-control" value="{{$user->lastname}}">
                        <div class="form-field__tooltip">
                            <span class="text">@lang('main.tooltips.characters_max', ["num"=> 32])</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-row__left">
                        <p><label class="" for="email">E-mail<span class="required-input">*</span></label></p>
                    </div>
                    <div class="form-row__right form-field">
                        <input type="text" name="email" class="input-control" value="{{$user->email}}">
                       
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-row__left">
                        <p><label class="" for="about">@lang('main.about_myself')</label></p>
                    </div>
                    <div class="form-row__right form-field">
                        <textarea name="about" id="about" rows="10">{{$user->about}}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-row__left">
                        <p><label class="" for="content">@lang('main.language')<span class="required-input">*</span></label></p>
                    </div>
                    <div class="form-row__right form-field">

                        <select name="language" class="section-categories">
                            @foreach ($listLanguages as $lang)
                            <option value="{{$lang}}" @if ($user->language==$lang)  selected @endif>{{$lang}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-row">
                  <div class="form-row__left">
                    <p><label class="" for="image">@lang('main.avatar')</label></p>
                  </div>
                  <div class="form-row__right form-field">
                    <div class="new-course__img new-course__img--size">
                      <img src="{{asset('/storage/'.$user->image)}}" alt="" id="user-avatar"><span class="icon"><i class="fas fa-camera"></i></span>
                      <label for="image" class="edit-foto"><i class="fas fa-edit"></i></label>
                    </div>
                    <label for="image" class="edit-foto"><p class="link-upload">@lang('main.upload')</p></label>
                    <input type="file" id="image" name="image" style="display: none">
                  </div>
                </div>


                <div class="form-btns-wrap">
              
                    <button class="btn" type="submit"><span class="icon m-r-8"><i class="fas fa-save"></i></span> @lang('main.save')</button>
                 
                </div>
            </form>



            @endsection
