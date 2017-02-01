@extends('guru.layout')

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
      <div class="col-md-12">
        <button data-toggle="modal" data-target="#myModal" style="min-width:100px;margin:5px;padding:5px;"type="button" class="btn btn-success pull-left"><i style="font-size:50px"class="fa fa-plus-square"></i><p> Tambah Data</p>
          </button>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Ruangan </h4>
              </div>
              <div class="modal-body">
                <form action="/guru/prasarana/ruangan/" method="post">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Ruangan : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="ruangan"  pattern=".{2,50}" maxlength="50" required title="Nama Ruangan tidak boleh kurang dari 2 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Ruangan" >
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Tempat Ruangan : <b style="color:red;">*</b></label>
                    <select class="form-control" name="prasarana_id" required>
                    @foreach($prasarana as $prasarana)
                    <option value="{{$prasarana->id}}">{{$prasarana->nama_prasarana}}</option>
                    @endforeach
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                </form>
              </div>
            </div>
          </div>
        </div>
        <a href="/guru/prasarana/ruangan/downloadExcel/xls"><button style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px" class="fa fa-file-excel-o"></i><p> Rekap  Data</p></button></a>    
        
      </div>
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
              <center><h3 class="box-title">Data Ruangan </h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Prasarana</th>
                  <th>Nama Prasarana</th>
                  <th>Nama Ruangan</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ruangan as $ruangan)
                @if($ruangan->id!=3)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$ruangan->kode_prasarana}}</td>
                  <td>{{$ruangan->nama_prasarana}}</td>
                  <td>{{$ruangan->ruangan}}</td>
                  <td>
                  <a href="/guru/prasarana/ruangan/{{ $ruangan->id }}"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                  <a href="/guru/prasarana/ruangan/{{ $ruangan->id }}/edit"><button class="btn btn-warning"><i class="fa fa-edit"></i></button> </a>
                  
                  <a href="/guru/prasarana/ruangan/{{ $ruangan->id }}/delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ruangan {{ $ruangan->id}} ?');">
                  <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                  
                  </td>
                </tr>
                <?php $no++; ?> 
                @endif
                
              @endforeach  
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Prasarana</th>
                  <th>Nama Prasarana</th>
                  <th>Nama Ruangan</th>
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
