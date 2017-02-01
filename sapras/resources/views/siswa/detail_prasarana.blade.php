@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Prasarana </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Prasarana  </li>
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
            <h3 class="box-title">Detail Prasarana</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <tr>
              <td>NIS Penanggung Jawab</td>
              <td><b> : </b></td>
              <td>{{ $prasarana->pj_prasarana }}</td>
              </tr>
              <tr>
              <td>Nama Penanggung Jawab</td>
              <td><b> : </b></td>
              <td>{{ $prasarana->namaguru }}</td>
              </tr>
              <tr>
              <td>Kode Sarana</td>
              <td><b> : </b></td>
              <td>{{ $prasarana->kode_prasarana }}</td>
              </tr>
              <tr>
              <td>Nama Sarana</td>
              <td><b> : </b></td>
              <td>{{ $prasarana->nama_prasarana }}</td>
              </tr>
              <tr>
              <td>Waktu Peresmian</td>
              <td><b> : </b></td>
              <td><?php 
                  $date=$prasarana->tahun_peresmian ;
                  $formatbaru = date('d F Y ', strtotime($date));
                  echo "$formatbaru";
                  ?></td>
              </tr>
              <tr>
              <td>Status Prasarana</td>
              <td><b> : </b></td>
              <td>{{ $prasarana->prasarana_status }}</td>
              </tr>
              <tr>
              <td>Kondisi Prasarana</td>
              <td><b> : </b></td>
              <td>{{ $prasarana->kondisi }}</td>
              </tr>
              <tr>
              <td>Keterangan Prasarana</td>
              <td><b> : </b></td>
              <td>
              @if(empty($prasarana->keterangan))
              -
              @else
              {{ $prasarana->keterangan }}  
              @endif
              
              </td>
              </tr>
              <tr>
              
                <td colspan="3">
                <a href="/siswa/prasarana/"><button class="btn btn-success">Kembali Ke halaman Olah Prasarana</button> </a>
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


