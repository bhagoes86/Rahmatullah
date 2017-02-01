@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Prasarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data praarana</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
      
      </div>
      <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
              <center><h3 class="box-title">Data Prasarana</h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Prasarana</th>
                  <th>Penanggung Jawab Prasarana</th>
                  <th>Status Prasarana</th>
                  <th>Kondisi Prasarana</th>
                  <th>Keterangan</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($prasarana as $prasarana)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$prasarana->nama_prasarana}}</td>
                  <td>{{$prasarana->namaguru}}</td>
                  <td>{{$prasarana->prasarana_status}}</td>
                  <td>{{$prasarana->kondisi}}</td>
                  <td>{{$prasarana->keterangan}}</td>
                  <td>
                  <a href="/siswa/prasarana/{{ $prasarana->id }}"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
               </td>
                </tr>
                <?php $no++; ?>
              @endforeach  
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Prasarana</th>
                  <th>Penanggung Jawab Prasarana</th>
                  <th>Status Prasarana</th>
                  <th>Kondisi Prasarana</th>
                  <th>Keterangan</th>
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



<!-- Bootstrap 3.3.6 -->

<!-- page script -->

@push('script-head')


<script>
  $(function () {
    $("#satu").DataTable();
    
  });
</script>
<!-- Bootstrap 3.3.6 -->
<!-- SlimScroll -->
<!-- page script -->

@endpush
