<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}@if(isset($title) && $title) {{ ' | '.$title }} @endif</title>

    @include('inc.styles')
    @yield('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @if(Auth::check())
        <div class="col-md-3 left_col">

          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                @if(Auth::check())
              <a href="{{ route('home') }}" class="site_title"><img src="{{ asset('logo.png') }}" class="img img-responsive w-25" alt=""> <span>{{ config('app.name') }}</span></a>
              @endif</div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                @if(Auth::check())
                <img src="@if (!Auth::user()->image) {{ asset("storage/uploads/users/user.png") }} @else {{ asset("storage/".Auth::user()->image) }} @endif" alt="Profile image" class="img-circle profile_img">
                @endif</div>
              {{-- <div class="profile_info">
                <span>Welcome,</span> --}}
                {{-- <h2>{{ Auth::user()->name }}</h2> --}}
              {{-- </div> --}}
              {{-- <div class="clearfix"></div> --}}
            </div>
            <!-- /menu profile quick info -->

            <br />
               @if(Auth::check())
            <!-- sidebar menu -->
            @include('inc.sidebar')
            <!-- /sidebar menu -->
            @endif
          </div>

        </div>
        @endif
        @if(Auth::check())
        <!-- top navigation -->
        @include('inc.topbar')
        <!-- /top navigation -->
        @endif
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                  <div class="title_left">
                    <h3>@if(isset($title) && $title) {{ $title }} @endif</h3>
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                  <div class="col-md-12 col-sm-12  ">
                      <div class="x_panel">
                          <div class="x_content">
                            @include('inc.alert')
                            @yield('content')
                        </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('inc.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('inc.scripts')

    @yield('js')
  </body>
</html>
