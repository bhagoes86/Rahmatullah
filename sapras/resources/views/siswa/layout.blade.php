<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Sarana & Prasarana SMKN 1 Cimahi || Halaman Guru</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{{ asset('bootstrap/css/bootstrap.min.css')}}}">
  <link rel="stylesheet" href="{{{ asset('css/font-awesome.min.css')}}}">
  <link rel="stylesheet" href="{{{ asset('css/ionicons.min.css')}}}">
  <link rel="stylesheet" href="{{{asset('/plugins/datatables/dataTables.bootstrap.css')}}}">
  <link rel="stylesheet" href="{{{asset('dist/css/AdminLTE.min.css')}}}">
  <link rel="stylesheet" href="{{{asset('dist/css/skins/_all-skins.min.css')}}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{{ asset('plugins/datepicker/datepicker3.css')}}}">
  <link rel="stylesheet" href="{{{ asset('plugins/daterangepicker/daterangepicker.css')}}}">
  <link rel="stylesheet" href="{{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}}">
<link rel="stylesheet" href="{{{ asset('js/jquery-ui.css')}}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
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
              <img src="{{{asset('images/user.png')}}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{{asset('images/user.png')}}}"  class="img-circle" alt="User Image">
                <p>
                  {{ Auth::user()->name }}
                  <small>NIS : {{ Auth::user()->username }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                  <a href="/siswa/profil/{{ Auth::user()->username }}"class="btn btn-default btn-flat">Profile</a>
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
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
   
   @extends('siswa.nav')
  
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper" style="overflow:hidden">
   @yield('content') 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; 2017 <a href="http://almsaeedstudio.com">SMK Negeri 1 Cimahi</a>.</strong> All rights
    reserved.
  </footer>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>


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
<!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>-->
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{{ asset ('plugins/morris/morris.min.js') }}}"></script>
<script src="{{{ asset ('plugins/sparkline/jquery.sparkline.min.js') }}}"></script>
<script src="{{{ asset ('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}}"></script>
<script src="{{{ asset ('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}}"></script>
<script src="{{{ asset ('plugins/knob/jquery.knob.js') }}}"></script>
<script src="cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

-->