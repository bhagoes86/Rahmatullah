@extends('guru.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Detail User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail User</li>
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
            <h3 class="box-title">Detail User</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
            @foreach($user as $user)
              
              @if($user->user_hak_akses_id==3)
              <tr>
              <td>NIS</td>
              <td><b> : </b></td>
              <td>{{ $user->username }}</td>
              </tr>
              <tr>
              <td>NISN </td>
              <td><b> : </b></td>
              <td>{{ $user->nisn }}</td>
              </tr>
              <tr>
              <td>Nama Siswa </td>
              <td><b> : </b></td>
              <td>{{ $user->namasiswa }}</td>
              </tr>
              <tr>
              <td>Jurusan </td>
              <td><b> : </b></td>
              <td>{{ $user->jurusan }}</td>
              </tr>
              @else
              <td>NIP</td>
              <td><b> : </b></td>
              <td>{{ $user->username }}</td>
              </tr>
              @endif
             
              <tr>
              <td>Level Akses User</td>
              <td><b> : </b></td>
              <td>{{ $user->user_hak_akses }}</td>
              </tr>
              <tr>
              <td>Status User </td>
              <td><b> : </b></td>
              <td>
              @if($user->status==0)
              Non Aktif
              @elseif($user->status==1)
              Aktif
              @endif
              </td>
              </tr>
              <tr>
              <td>Ubah Status User</td>
              <td><b> : </b></td>
              <td><a href="/guru/user/{{ $user->id }}/3" onclick="return confirm('Apakah anda yakin ingin Mengaktifkan user ');"><button class="btn btn-success"><i class="fa fa-check"></i></button> </a>
                <a href="/guru/user/{{ $user->id }}/4"onclick="return confirm('Apakah anda yakin ingin menonaktifkan');">
                  <button class="btn btn-danger"><i class="fa fa-close"></i></button> </a></td>
              </tr>

              @if($user->user_hak_akses_id!=3)
              <tr>
              <td>Ubah Level User</td>
              <td><b> : </b></td>
              <td><a href="/guru/user/{{ $user->id }}/1" onclick="return confirm('Apakah anda yakin ingin menghapus mengubah level user menjadi Administrator');"><button class="btn btn-warning"><i class="fa fa-arrow-up"></i></button> </a>
                <a href="/guru/user/{{ $user->id }}/2"onclick="return confirm('Apakah anda yakin ingin menghapus mengubah level user Operator');">
                  <button class="btn btn-warning"><i class="fa fa-arrow-down"></i></button> </a></td>
              </tr>
              <tr>
              @endif
                <td colspan="3">
                <a href="/guru/user/" class="btn btn-success ">Kembali Ke halaman Olah user
                  </a>
                 <a href="/guru/user/{{$user->id}}/edit" class="btn btn-primary ">Update Data
                  </a>
              </td>
              </tr>
              @endforeach
            </table>
            
          </div>
          <!-- /.box-body -->
        </div>
      </div>
</section>
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->


@stop



<!-- Bootstrap 3.3.6 -->

<!-- page script -->






