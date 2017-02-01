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
                <h4 class="modal-title" id="myModalLabel">Tambah Data Prarana</h4>
              </div>
              <div class="modal-body">
                <form action="/guru/prasarana/" method="post">
                {{ csrf_field() }}
                 <div class="form-group">
                    <label for="recipient-name" class="control-label">Kode Prasarana : <b style="color:red;">*</b></label>
                    <input  type="text" class="form-control" name="kode_prasarana" pattern=".{3,20}" maxlength="20" required title="Kode Prasarana tidak boleh kurang dari 3 karakter & tidak lebih dari 20 Karakter " placeholder="Masukan Kode prasarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Prasarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="nama_prasarana"  pattern=".{5,50}" maxlength="50" required title="Nama Prasarana tidak boleh kurang dari 5 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Prasarana" >
                  </div>
                  
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Status Prasarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="prasarana_status_id" required>
                       @foreach ($status as $status) 
                       <option value='{{ $status->id }}'>
                       {{ $status->prasarana_status }} 
                       </option>
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Kondisi Prasarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      
                      <select class="form-control" name="prasarana_kondisi_id" required>
                       @foreach ($kondisi as $kondisi) 
                       <option value='{{ $kondisi->id }}'>
                       {{ $kondisi->kondisi }} 
                       </option>
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">NIP Penanggung Jawab : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="pj_prasarana" pattern="[0-9]{3,25}" maxlength="25" required title="NIP Penanggung Jawab Harus Karakter Numerik" placeholder="Masukan NIP Penanggung Jawab">
                  </div>
                  <div class="form-group">
                      <label>Waktu Diresmikan : <b style="color:red;">*</b></label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="tahun_peresmian" type="text" class="form-control pull-right" id="datepicker" required>
                      </div>
                      <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : </label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukan Keterangan Prasarana"></textarea>
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
        <a href="/guru/prasarana/downloadExcel/xls"><button style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px" class="fa fa-file-excel-o"></i><p> Rekap  Data</p></button></a>    
        <button data-toggle="modal" data-target="#myModal2" style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px"class="fa fa-upload"></i><p> Import Data</p>
        </button>
       <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Import Data</h4>
            </div>
          <div class="modal-body">
          <div class="form-group">
          <label for="recipient-name" class="control-label">Syarat Import Data:</label>
          <p>Data harus berupa file excel dengan mengikuti format yang sudah ditentukan , format data bisa didownload <b><a href="{{{asset('download/format_prasarana.xls')}}}" download> disini</a></b></p>
          <label for="recipient-name" class="control-label">Import Data:</label>
           <form action="/guru/prasarana/importExcel" class="form-horizontal" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
          <input class="form-control"  required type="file" name="import_file" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input value="Simpan Data" type="submit" class="btn btn-primary"></input>
             </form>
          </div>
        </div>
      </div>  
          
      </div>
      </div>
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
                  <a href="/guru/prasarana/{{ $prasarana->id }}"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                  <a href="/guru/prasarana/{{ $prasarana->id }}/edit"><button class="btn btn-warning"><i class="fa fa-edit"></i></button> </a>
                  <a href="/guru/prasarana/{{ $prasarana->id }}/delete" onclick="return confirm('Apakah anda yakin ingin menghapus data prasarana {{ $prasarana->nama_prasarana}} ?');">
                  <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
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
