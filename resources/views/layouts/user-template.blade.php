<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('images/newLogoFarbenBlau2.png') }}">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title> @yield('title') </title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  {{-- <link href="{{ asset('css/myStyles.css') }}" rel="stylesheet" /> --}}
  {{-- Select2-Libary einbinden --}}
  {{-- <link href="{{ asset('css/select2.css') }}" rel="stylesheet" /> --}}
</head>
<body class="hold-transition sidebar-mini">

@include('inc.menu')
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"> <strong class="nav-link"> <span class="fa fa-id-badge fa-lg"></span> {{ Auth::user()->nachname }}, {{ Auth::user()->vorname }} </strong> </li>
        <li class="nav-item">    
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <span class="fa fa-power-off fa-lg"></span>
             {{-- {{ __('Logout') }}  --}}
          </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
          </form>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <div class="menubtn"  onclick="openNav()">
            <img id="menubtn" src="{{ asset('images/button_icon.png') }}" alt="Button Icon">
        </div>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  @include('inc.sidebarNew')
  
  <div class="content-wrapper">
 
      @include('inc.messages') 
      @yield('content')
  
  </div>
  
<!-- ./wrapper -->
@include('inc.footer')

<script src="{{ asset('js/app.js') }}" defer></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('js/admin/jquery.min.js') }}" defer></script> --}}

{{-- Script für MultiselectBox --}}
<script src="{{ asset('js/select2Use.js') }}"></script>
<!-- Bootstrap -->
{{-- <script src="{{ asset('js/admin/bootstrap.bundle.min.js') }}" defer></script> --}}
{{--   --}}
<script src="{{ asset('js/menu.js') }}" defer></script>

<script src="{{ asset('js/select2.full.js') }}" defer></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/admin/adminlte.js') }}" defer></script>

<!-- SparkLine -->
{{-- <script src="{{ asset('js/admin/jquery.sparkline.min.js') }}" defer></script> --}}

<!-- SlimScroll 1.3.0 -->
{{-- <script src="{{ asset('js/admin/jquery.slimscroll.min.js') }}" defer></script> --}}

</body>
</html>
