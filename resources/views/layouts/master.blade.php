
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dev | App</title>
  <link rel="stylesheet" href="{{mix("css/app.css")}}" />
@livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Navbar -->
  <!-- Navbar -->
  <x-topnav />
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      
      <span class="brand-text font-weight-bold"style="font-size: 1.3em;">DevApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{asset('images/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
         
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     
      <!-- Sidebar Menu -->
     <x-menu /> 
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
   
          @yield("contenu")
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 <x-sidebar /> 
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#">DevApp</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{ mix('js/app.js')}}"> </script> 
@livewireScripts
</body>
</html>
