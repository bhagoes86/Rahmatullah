
@extends('guru.layout')



@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Laporan Praarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Laporan Prasarana</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      
      <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Permintaan Pinjamana Prasarana</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIS</th>
                  <th>Jenis Laporan</th>
                  <th>Keterangan</th>
                  <th>Waktu Laporan</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>131010712</td>
                  <td>Kursi Plastik
                  </td>
                  <td>2</td>
                  <td> 4 Desember 2016</td>
                 <td><button class="btn btn-success">Selengkapnya</button> 
                 <button class="btn btn-danger">Hapus</button></td>
                </tr>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>NIS</th>
                  <th>Jenis Laporan</th>
                  <th>Keterangan</th>
                  <th>Waktu Laporan</th>
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



  @endpush

<!-- Bootstrap 3.3.6 -->

<!-- page script -->

