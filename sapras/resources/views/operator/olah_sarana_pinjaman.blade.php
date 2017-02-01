
@extends('guru.layout')



@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Permintaan Pinjman Sarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Permintaan Pinjman Sarana</li>
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
              <h3 class="box-title">Data Permintaan Pinjamana Sarana</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>NIS Siswa</th>
                  <th>Nama Sarana</th>
                  <th>Total Pinjam</th>
                  <th>Waktu Peminjaman</th>
                  <th>Lama Pinjam</th>
                  <th>Status Peminjaman</th>
                   <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sarana as $sarana)
                <tr>
                <td>{{ $sarana->nis}}</td>
                  <td>{{ $sarana->nama_sarana}}</td>
                  <td>{{ $sarana->jumlah_pinjam}} Barang
                  </td>
                  <td>{{ $sarana->waktu_pinjam}}</td>
                  <td>{{ $sarana->waktu_pengembalian}} Hari</td>
                 <td>{{ $sarana->status_pinjam}}</td>
                 <td>
                 <a href="/guru/sarana_pinjaman/{{$sarana->id}}/1"><button class="btn btn-success">Koonfirmasi</button> </a>
                 <a href="/guru/sarana_pinjaman/{{$sarana->id}}/2"><button class="btn btn-warning">Tunggu</button></a>
                 <a href="/guru/sarana_pinjaman/{{$sarana->id}}/3"><button class="btn btn-danger">Tolak</button></a>
                 </td>
                </tr>
                @endforeach
                
                
                </tbody>
                <tfoot>
                <tr>
                  <th>NIS Siswa</th>
                  <th>Nama Sarana</th>
                  <th>Total Pinjam</th>
                  <th>Waktu Peminjaman</th>
                  <th>Lama Pinjam</th>
                  <th>Status Peminjaman</th>
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

