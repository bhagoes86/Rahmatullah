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
<body bgcolor="red" style="background-size:cover;background-image:url({{{ asset('images/bg2.jpg')}}}) !important;"  class="hold-transition login-page">

<div style="background-color:rgba(0,0,0,0.5);height:100%;width:100%"><br>
<div class="login-box" style="margin-top:0;">
  <!-- /.login-logo -->
  <div style="border:5px solid #cccccc" class="login-box-body">
  <center><img src="{{{ asset('images/logo.png')}}}" style="width:50%"></img></center>
   <div class="login-logo">
    <a href="#"><b>SAPRAS</b><br> SMK Negeri 1 Cimahi</a>
  </div>
    <p class="login-box-msg">Silahkan Masukan Kata Kunci Pencarian</p>

    <form method="POST" action="{{ url('/cari') }}">
     {{ csrf_field() }}
     <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            

                            <div >
                                <input id="text" type="username" class="form-control" name="search" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
    
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Cari Data</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>d
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
