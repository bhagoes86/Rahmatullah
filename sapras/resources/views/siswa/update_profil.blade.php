@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
    <div class="col-md-12">
       <div class="flash-message">
       @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @else
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <center><p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p></center>
          @endif
        @endforeach
        @endif
      </div> <!-- end .flash-message -->
      </div>
      
      </div>
      <div class="row" style="padding:15px">
      <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Update Profil</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              @foreach($profil as $profil)
              <form action="/siswa/profil/{{ $profil->username }}/update" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
              <div class="form-group">
                    <label for="recipient-name" class="control-label">NIS Siswa :</label>
                    <input type="text" class="form-control" value="{{$profil->username}}" disabled="disabled" name="username">
              </div>
              <div class="form-group">
                    <label for="recipient-name" class="control-label">NISN Siswa :</label>
                    <input type="text" class="form-control" value="{{$profil->nisn}}" disabled="disabled" name="nisn">
              </div>
              <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Siswa :</label>
                    <input type="text" class="form-control" value="{{$profil->namasiswa}}" disabled="disabled" name="nama">
              </div>
              <div class="form-group">
                    <label for="recipient-name" class="control-label">Jurusan :</label>
                    <input type="text" class="form-control" value="{{$profil->jurusan}}" disabled="disabled" name="jurusan">
              </div>
              <div class="form-group">
                   <label for="recipient-name" class="control-label">Level User :</label>
                    <input disabled="disabled" type="text" class="form-control" value="{{$profil->name}}"  name="name">
              </div>
              <div class="form-group">
                    <label for="recipient-name" class="control-label">Password Sebelumnnya : <b style="color:red;">*</b></label>
                    <input type="password" class="form-control"  name="password1" maxlength="15" placeholder="Masukan Password Sekarang" required="">
              </div>
               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class=" control-label">Password : <b style="color:red;">*</b></label>

                            <div class="">
                                <input id="password" type="password" class="form-control" pattern="{6,16}" name="password" maxlength="16" required title="Password Harus Tidak kurang dari 6 Karakter atau tidak lebih dari 16 Karakter " placeholder="Masukan Password Baru">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Konfirmasi Password : <b style="color:red;">*</b></label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="16"  pattern="{6,16}" required title="Konfirmasi Password Harus Tidak kurang dari 6 Karakter atau tidak lebih dari 16 Karakter " placeholder="Masukan Konfirmasi Password Baru" >
                            </div>
                        </div>
              <div class="form-group">
                    <label for="recipient-name" class="control-label">Status Siswa :</label>
                    <input type="text" class="form-control" value="{{$profil->status}}" disabled="disabled" name="status">
              </div>
              
              <tr>
              
                <td colspan="3">
                 <input type="submit" name="submit" class="btn btn-primary" value="Update">
                  @endforeach
                  </form>
              </td>
              </tr>
            </table>
            
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->


@stop



<!-- Bootstrap 3.3.6 -->

<!-- page script -->


