@extends('guru.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Pengajuan Sarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Pengajuan Sarana</li>
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
            <h3 class="box-title">Detail Pengajuan Sarana</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <tr>
              <td>NIS</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nis }}</td>
              <tr>
              <td>Nama Siswa</td>
              <td><b> : </b></td>
              <td>{{ $sarana->namasiswa }}</td>
              </tr>
              <td>Jurusan Siswa</td>
              <td><b> : </b></td>
              <td>{{ $sarana->jurusan }}</td>
              </tr>
              <td>Nama Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nama_sarana }}</td>
              </tr>

              <tr>
              <td>Waktu Pengajuan</td>
              <td><b> : </b></td>
              <td><?php 
                  $date=$sarana->tgl ;
                  $formatbaru = date('d F Y ', strtotime($date));
                  echo "$formatbaru";
                  ?></td>
              </tr>

              <tr>
              <td>Tipe Saranan </td>
              <td><b> : </b></td>
              <td>{{ $sarana->tipe_sarana }} </td>
              </tr>
              
              <tr>
              <td>Merek Sarana </td>
              <td><b> : </b></td>
              <td>{{ $sarana->merek_sarana }} </td>
              </tr>
              
              <tr>
              <td>Total Sarana Dibutuhkan </td>
              <td><b> : </b></td>
              <td>{{ $sarana->total_sarana }} Barang</td>
              </tr>
              
              <tr>
              <td>Status Pengajuan</td>
              <td><b> : </b></td>
              <td>{{ $sarana->status_pengajuan }}</td>
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
               <a href="/guru/sarana/pengajuan/{{$sarana->id}}/1"><button class="btn btn-success" onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi pengajuan sarana');"><i class="fa fa-check"></i></button> </a>
                <a href="/guru/sarana/pengajuan/{{$sarana->id}}/3" onclick="return confirm('Apakah anda yakin ingin menolah pengajuan sarana');"><button class="btn btn-danger"><i class="fa fa-close"></i></button></a>
              </td>
              </tr>
              <tr>
              
                <td colspan="3">
                <a href="/guru/sarana/pengajuan/"><button class="btn btn-success">Kembali Ke Halaman Olah Pengajuan</button> </a>
                <a href="/guru/sarana/pengajuan/{{ $sarana->id }}/edit/"><button class="btn btn-primary">Update Data</button> </a>
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


