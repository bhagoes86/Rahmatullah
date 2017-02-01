<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Sarana & Prasarana SMKN 1 Cimahi || Halaman Guru</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="{{{ asset('bootstrap/css/bootstrap.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('css/font-awesome.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('css/ionicons.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('plugins/datatables/dataTables.bootstrap.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('dist/css/AdminLTE.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('dist/css/skins/_all-skins.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('plugins/datepicker/datepicker3.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('plugins/daterangepicker/daterangepicker.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="{{{ asset('js/jquery-ui.css')}}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="/guru/home/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SA</b>PRAS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('images/user.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('images/user.png') }}" class="img-circle" alt="User Image">
                <p>
                  {{ Auth::user()->name }}
                  <small>NIP : {{ Auth::user()->username }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div >
                <div class="pull-right">
                  <a href="/guru/profil/{{Auth::user()->username}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-left">
                <a class="btn btn-default btn-flat" href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                  
                  </div> 
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
   @extends('guru.nav')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="overflow:hidden">
   @yield('content') 
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; 2017 <a href="#">SMK Negeri 1 Cimahi</a>.</strong> All rights
    reserved.
  </footer>

  <script src="{{{ asset ('plugins/jQuery/jquery-2.2.3.min.js') }}}"></script>
  <script src="{{{ asset ('bootstrap/js/bootstrap.min.js') }}}"></script>
  <script src="{{{ asset ('plugins/datatables/jquery.dataTables.min.js') }}}"></script>
  <script src="{{{ asset ('plugins/datatables/dataTables.bootstrap.min.js') }}}"></script>
  @stack('script-head')
  <script src="{{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}}"></script>
  <script src="{{{ asset ('plugins/slimScroll/jquery.slimscroll.min.js') }}}"></script>
  <script src="{{{ asset ('plugins/fastclick/fastclick.js') }}}"></script>
  <script src="{{{ asset ('dist/js/app.min.js') }}}"></script>
  <script src="{{{ asset ('dist/js/pages/dashboard.js') }}}"></script>
  <script src="{{{ asset ('dist/js/demo.js') }}}"></script>
  <script src="{{{ asset ('plugins/daterangepicker/daterangepicker.js') }}}"></script>
  <script src="{{{ asset ('plugins/datepicker/bootstrap-datepicker.js') }}}"></script>
  <script type="text/javascript">
    $('#datepicker').datepicker({
        autoclose: true
      });
  </script>
</body>
</html>
