@extends('layouts.default')

@section('class-body') admin @endsection

@section('content')

<div class="main-wrap">
  <h2 class="margin-top-20">@lang('main.admin_panel')</h2>
  <section class="profile-wrapper">
    
    @include('admin.parts.sidebar')

    <main class="profile-content">

      <h3 class="title">@lang('main.publishing_courses')</h3>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>@lang('main.title')</th>
              <th>@lang('main.update_date')</th>
      
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($courses as $course)
            @php  $timeUpdated = Carbon\Carbon::parse($course->updated_at)->format("d.m.Y h:i"); @endphp
            <tr>
              <td class="table-img"><img src="{{asset("storage/".$course->image)}}" alt="img"></td>
              <td class="profile-content-table-course__title"><a href="{{route("profile.course.show", $course)}}">{{$course->__("title")}}</a></td>
                
              <td class="vertical-m">{{$timeUpdated}}</td>
                
              <td class="table-btn vertical-m"><a href="{{route("admin.publishedCourse", $course->id)}}" class="btn">@lang('main.publish')</a></td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>

      <section class="paginate center">
        {{$courses->links()}}
      </section>
    </main>
  </section>
</div>

@endsection
