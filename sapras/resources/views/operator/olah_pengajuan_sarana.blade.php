
@extends('operator.layout')



@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Pengjuan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Pengajuan</li>
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
              <b><center><h3 class="box-title">Data Permintaan Pengajuan Sarana</h3></center></b>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Sarana</th>
                  <th>Merek Sarana</th>
                  <th>Tipe Sarana</th>
                  <th>Waktu Pengajuan</th>
                  <th>Banyak Pengajuan</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>

                @foreach($pengajuan as $pengajuan)
                <tr>
                  <td>{{ $no}}</td>
                  <td>{{ $pengajuan->nis}}</td>
                  <td>{{ $pengajuan->nama_sarana}}</td>
                  <td>{{ $pengajuan->merek_sarana}}</td>
                  <td>{{ $pengajuan->tipe_sarana}}</td>
                  
                  <td><?php 
                  $date=$pengajuan->tgl ;
                  $formatbaru = date('d F Y ', strtotime($date));
                  echo "$formatbaru";$no++;
                  ?></td>
                  <td>{{ $pengajuan->total_sarana }} Sarana</td>
                 <td>
                  <a href="/operator/sarana/pengajuan/{{ $pengajuan->id }}"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                  @if($pengajuan->pengajuan_status_id==2)
                 <a href="/operator/sarana/pengajuan/{{ $pengajuan->id }}/delete" onclick="return confirm('Apakah anda yakin ingin menghapus data pengajuan {{ $pengajuan->nama_sarana}} ?');"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                 @endif
                 </td>

                </tr>
                @endforeach
  
                
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Sarana</th>
                  <th>Merek Sarana</th>
                  <th>Tipe Sarana</th>
                  <th>Waktu Pengajuan</th>
                  <th>Banyak Pengajuan</th>
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

