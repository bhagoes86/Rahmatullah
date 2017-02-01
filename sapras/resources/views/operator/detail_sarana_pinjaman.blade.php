@extends('operator.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Sarana Terpinjam</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Sarana Terpinjam</li>
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
            <h3 class="box-title">Detail Sarana Terpinjam</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
            @foreach($sarana as $sarana)
              <tr>
              <td>NIS</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nis }}</td>
              <tr>
              <td>Nama Siswa</td>
              <td><b> : </b></td>
              <td>{{ $user->namasiswa }}</td>
              </tr>
              <td>Jurusan Siswa</td>
              <td><b> : </b></td>
              <td>{{ $user->jurusan }}</td>
              </tr>
              <td>Nama Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nama_sarana }}</td>
              </tr>
              <tr>
              <td>Waktu Peminjaman</td>
              <td><b> : </b></td>
              <td>
              <?php 
                    $date=$sarana->waktu_pinjam ;
                    $formatbaru = date('d F Y ', strtotime($date));
                    echo "$formatbaru";
              ?>
              
              </td>
              </tr>
              <tr>
              <td>Lama Pinjam</td>
              <td><b> : </b></td>
              <td>{{ $sarana->waktu_pengembalian }} Hari</td>
              </tr>
              <tr>
              <td>Total Pinjam</td>
              <td><b> : </b></td>
              <td>{{ $sarana->jumlah_pinjam }} Barang</td>
              </tr>
              <tr>
              <tr>
              <td>Status Pinjaman</td>
              <td><b> : </b></td>
              <td>{{ $sarana->status_pinjam }}</td>
              </tr>
              <tr>
              <td>Keterangan Pinjaman</td>
              <td><b> : </b></td>
              <td>
              @if(empty($sarana->keterangan))
              -
              @else
              {{ $sarana->keterangan }}  
              @endif
              
              </td>
              </tr>
              <tr>
              <td>
              Ubah Status Pinjaman
              </td>
              <td>
              <B>:</B>
              </td>
              <td>
                
                <a href="/operator/sarana/pinjaman/{{$sarana->id}}/1"><button class="btn btn-success"></i>Konfirmasi</button> </a>
                <a href="/operator/sarana/pinjaman/{{$sarana->id}}/2"><button class="btn btn-warning">Tunggu</button></a>
                <a href="/operator/sarana/pinjaman/{{$sarana->id}}/3"><button class="btn btn-danger"></i>Tolak</button></a>
                <a href="/operator/sarana/pinjaman/{{$sarana->id}}/4"><button class="btn btn-primary"></i>Sudak Dikembalikan</button> </a>
              </td>
              </tr>
              <tr>
                
                <td colspan="3">
                <a href="/operator/sarana/pinjaman/"><button class="btn btn-success">Kembali Ke Halaman Olah Pinjaman</button> </a>
                
              </td>
              </tr>
              @endforeach
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


