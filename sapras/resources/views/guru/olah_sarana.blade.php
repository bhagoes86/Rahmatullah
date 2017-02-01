@extends('guru.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Sarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Sarana</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
      <div class="col-md-12">
        <button data-toggle="modal" data-target="#myModal" style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px" class="fa fa-plus-square"></i><p> Tambah Data</p>
          </button>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Sarana</h4>
              </div>
              <div class="modal-body">
                <form action="/guru/sarana/" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kode Sarana : <b style="color:red;">*</b></label>
                    <input  type="text" class="form-control" name="kode_sarana" pattern=".{3,20}" maxlength="20" required title="Kode Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 20 Karakter " placeholder="Masukan Kode Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="nama_sarana" pattern=".{5,50}" maxlength="50" required title="Nama Sarana tidak boleh kurang dari 5 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Sarana" >
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nomer Register Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="no_regis" pattern=".{3,15}" maxlength="15"  required title="Nomer Register Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 15 Karakter " placeholder="Masukan Nomer Register Sarana">
                  </div>
                  
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Merek/Tipe Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="merk_sarana" pattern=".{3,50}" maxlength="50" required title="Merek/Tipe Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 50 Karakter" placeholder="Masukan Merek/Tipe Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Bahan Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="bahan" pattern=".{3,15}" maxlength="15"  required title="Bahan Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 25 Karakter " placeholder="Masukan Bahan Sarana">
                  </div>
                   <div class="form-group">
                    <label for="recipient-name" class="control-label">Tahun Pembelian   : <b style="color:red;">*</b></label>
                    <div class="input-group date" data-provide="datepicker">
                      <input type="text" class="form-control" name="tahun_pembelian" required title="Tahun Pembelian Sarana Harus Diisi Dengan Benar" >
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                    <!--<input type="number" name="tahun_pembelian"class="form-control"  min="0" step="1" />-->
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Asal Usul Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="asal_sarana" pattern=".{3,15}" maxlength="15"  required title="Asal Usul Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 15 Karakter" placeholder="Masukan Asal Usul Sarana">
                  </div>
                   <div class="form-group">
                    <label for="recipient-name" class="control-label">Harga Satuan  : (Rp.)<b style="color:red;">*</b></label>
                    <input name="harga_sarana"type="number" class="form-control" id="replyNumber" min="0" step="1000" required title="Harga Sarana Dalam Satuan Rupiah" />
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Total Sarana : <b style="color:red;">*</b></label>
                    <input name="total_sarana"type="number" class="form-control" id="replyNumber" min="0" step="1" required/>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Status Sarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="sarana_status_id" required>
                       @foreach ($status as $status) 
                       <option value='{{ $status->id }}'>
                       {{ $status->status}} 
                       </option>
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Kondisi Sarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="sarana_kondisi_id" required>
                       @foreach ($kondisi as $kondisi) 
                       <option value='{{ $kondisi->id }}'>
                       {{ $kondisi->kondisi}} 
                       </option>
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Ruangan Sarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="sarana_ruangan_id" required>
                       @foreach ($ruangan as $ruangan) 
                       <option value='{{ $ruangan->id }}'>
                       {{ $ruangan->ruangan}} 
                       </option>
                       @endforeach
                      
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : </label>
                    <textarea class="form-control" id="Keterangan" name="keterangan" maxlength="255" placeholder="Masukan Keterangan"></textarea>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Tambah Data">
              </div>
              </form>
            </div>
          </div>
        </div>
        <a href="/guru/sarana/downloadExcel/xls"><button style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px" class="fa fa-file-excel-o"></i><p> Rekap  Data</p></button></a>    
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
          <p>Data harus berupa file excel dengan mengikuti format yang sudah ditentukan , format data bisa didownload <b><a href="{{{asset('download/sarana.zip')}}}" download> disini</a></b></p>
          <label for="recipient-name" class="control-label">Import Data:</label>
           <form action="/guru/sarana/importExcel" class="form-horizontal" method="post" enctype="multipart/form-data">
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
              <center><h3 class="box-title">Data Sarana</h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Sarana</th>
                  <th>Nama Sarana</th>
                  <th>Total Sarana</th>
                  <th>Sarana Terpinjam</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sarana as $sarana)    
                <tr>
                  <td>{{ $no}} </td>
                  <td>{{ $sarana->kode_sarana}} </td>
                  <td>
                  {{ $sarana->nama_sarana}}
                  </td>
                  <td>{{ $sarana->total_sarana}} Sarana</td>
                  <td>
                    @if(!($pinjam->isEmpty()))
                    <?php $total_pinjaman=0; $no++; ?>
                    @foreach($pinjam as $p)
                           @if($p->sarana_id==$sarana->id)
                            <?php
                            $total_pinjaman=$p->total;
                            ?>
                            @elseif($p->sarana_id!=$sarana->id)
                            <?php
                            continue;
                            ?>
                            @endif
                      @endforeach
                      @endif
                      {{$total_pinjaman}} Sarana
                  </td>
                  <td>
                  <a href="/guru/sarana/{{ $sarana->id }}/"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                  <a href="/guru/sarana/{{ $sarana->id }}/edit/">
                  <button class="btn btn-warning"><i class="fa fa-edit"></i></button></a>
                  <a href="/guru/sarana/{{ $sarana->id }}/delete/"onclick="return confirm('Apakah anda yakin ingin menghapus {{ $sarana->nama_sarana}} ?');">
                  <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Sarana</th>
                  <th>Nama Sarana</th>
                  <th>Total Sarana</th>
                  <th>Sarana Terpinjam</th>
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
