 <!-- Head -->
 @include('admin.layout.head')


@php

@endphp
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 0px !important;">

    <!-- Top navbar links -->
    @include('admin.layout.top-navbar')


    <!-- Right navbar links -->
    @include('admin.layout.right-sidebar')

  </nav>


  <div class="offcanvas offcanvas-start w-50" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-primary" id="offcanvasExampleLabel">Employee Task <span class="text-muted">Portal</span></h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="">
      <ul class="nav-mobile" style="margin-left: opx;">




        <li class="nav-item">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <a class="nav-link-mbile ml-2" aria-current="page" href="">Tasks</a>
        </li>
        <br/>


      </ul>
    </div>
  </div>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="ml-4 mr-4">
    <div class="content">
        @yield('content')
    </div>
    <!-- /.content -->
  </div>


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@include('admin.layout.footer')
