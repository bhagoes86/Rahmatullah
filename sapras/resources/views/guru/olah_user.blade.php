
@extends('guru.layout')



@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data user</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
      <div class="col-md-12">
        <button data-toggle="modal" data-target="#myModal" style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px" class="fa fa-plus-square"></i><p> Tambah Data</p>
          </button>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
              </div>
              <div class="modal-body">
               <form role="form" method="POST" action="/guru/user/">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class=" control-label">NIP / NIS : <b style="color:red;">*</b> </label>

                            <div class="">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" pattern="[0-9]{3,25}" maxlength="25" required title="NIP/NS Jawab Harus  Karakter Numerik" placeholder="Masukan NIP/NIS User">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class=" control-label">Password : <b style="color:red;">*</b></label>

                            <div class="">
                                <input id="password" type="password" class="form-control" pattern="{6,16}" name="password" maxlength="16" required title="Password Harus Tidak kurang dari 6 Karakter atau tidak lebih dari 16 Karakter " placeholder="Masukan Password User">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="16"  pattern="{6,16}" required title="Konfirmasi Password Harus Tidak kurang dari 6 Karakter atau tidak lebih dari 16 Karakter " placeholder="Masukan Konfirmasi Password User" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Level User : <b style="color:red;">*</b></label>
                                <select name="user_hak_akses" class="form-control">
                                @foreach($hak as $hak)
                                <option value="{{$hak->id}}">{{$hak->user_hak_akses}}</option>
                                @endforeach
                                </select>
                        </div>

                        
                    
                

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>

          
        
      </div>
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
      <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
              <b><center><h3 class="box-title">Data user </h3></center></b>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>No</th>
                  <th>NIP / NIS</th>
                  <th>Nama User</th>
                  <th>Waktu Registrasi</th>
                  <th>Level Hak Akses</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @if($user)
                @foreach($user as $user)
                <tr>
                	<td>{{ $no}}</td>
                  <td>{{ $user->username}}</td>
                  <td>
                  @foreach($guru as $g)
	                  @if($user->username==$g->nip)
	                  {{$g->namaguru}}
	                  @else
	                  <?php 
	                  continue;
	                  ?>
	                  @endif
                  @endforeach
                  
                  @foreach($siswa as $s)
	                  @if($user->username==$s->nis)
	                  {{ $s->namasiswa }}
	                  @else
	                  <?php 
	                  continue;
	                  ?>
	                  @endif
                  @endforeach
                  </td>
                  <td>
                  <?php 
                  $date=$user->created_at ;
                  $formatbaru = date('d F Y ', strtotime($date));
                  echo "$formatbaru";
                  $no++;
                  ?>
                  </td>
                  <td>{{ $user->user_hak_akses }}</td>
                 <td>
                 <a href="/guru/user/{{ $user->id }}"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                 <a href="/guru/user/{{ $user->id }}/edit"><button class="btn btn-warning"><i class="fa fa-edit"></i></button> </a>
                 <a href="/guru/user/{{ $user->id }}/delete" onclick="return confirm('Apakah anda yakin ingin menghapus data user {{ $user->username}} ?');"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                 </td>
                </tr>
                @endforeach
                @else
                <tr>
                	<td colspan="5">
                	<center>Tidak Ada Data Tersimpan</center>
                	</td>
                </tr>
                @endif
                
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIP / NIS</th>
                  <th>Nama User</th>
                  <th>Waktu Registrasi</th>
                  <th>Level Hak Akses</th>
                  <th>Operasi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>    
        </div>
        
  
      </div>
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

@stop

@push('script-head')

<script>
  $(function () {
    $("#satu").DataTable();
    
  });
</script>
@endpush

<!-- Bootstrap 3.3.6 -->

<!-- page script -->

