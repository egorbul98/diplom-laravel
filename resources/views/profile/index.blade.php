@extends('layouts.default')

@section('class-body') profile @endsection

@section('content')

@include('profile.parts.profile-header')

<div class="main-wrap">
  <section class="profile-wrapper">
    
    @include('profile.parts.sidebar')

    <main class="profile-content">
      <h3 class="title">Все курсы</h3>
      
      @include('profile.parts.tables.table-courses')

    </main>
  </section>
</div>

@endsection
