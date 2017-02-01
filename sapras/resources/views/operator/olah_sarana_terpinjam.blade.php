
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
      <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
              <center><h3 class="box-title">Data Permintaan Pinjaman</h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS Peminjam</th>
                  <th>Kode Sarana</th>
                  <th>Status Pinjaman</th>
                  <th>Total Pinjam</th>
                  <th>Waktu Peminjaman</th>
                  
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pinjam as $pinjam)
                <tr>
                  <td>{{ $no}}</td>
                  <td>{{ $pinjam->nis}}</td>
                  <td>{{ $pinjam->kode_sarana}}</td>
                  <td>{{ $pinjam->status_pinjam}}</td>
                  <td>{{{$pinjam->jumlah_pinjam}}} Sarana</td>
                  <td> <?php 
                  $no++;
                  $date=$pinjam->waktu_pinjam ;
                  $formatbaru = date('d F Y ', strtotime($date));
                  echo "$formatbaru";
                  ?></td>
                 <td>
                 <a href="/operator/sarana/pinjaman/{{ $pinjam->id }}/"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                 @if($pinjam->sarana_pinjam_status_id==4)
                 <a href="/operator/sarana/pinjaman/{{ $pinjam->id }}/delete/" onclick="return confirm('Apakah anda yakin ingin menghapus data peminjaman {{ $pinjam->nama_sarana}} ?');"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                 @endif
                 </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIS Peminjam</th>
                  <th>Kode Sarana</th>
                  <th>Status Pinjaman</th>
                  <th>Total Pinjam Sarana</th>
                  <th>Waktu Peminjaman</th>
                  
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

