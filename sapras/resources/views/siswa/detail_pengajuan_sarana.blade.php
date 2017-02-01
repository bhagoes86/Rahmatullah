@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Data Pengajuan Sarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengajuan Sarana</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
    
      
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
              
                <td colspan="3">
                <a href="/siswa/sarana/pengajuan/"><button class="btn btn-success">Kembali Ke Halaman Olah Pengajuan</button> </a>
                @if($sarana->pengajuan_status_id==3)
                <a href="/siswa/sarana/pengajuan/{{ $sarana->id }}/edit/"><button class="btn btn-primary">Update Data</button> </a>
                @endif
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


