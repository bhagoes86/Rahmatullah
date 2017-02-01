
@extends('siswa.layout')



@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Data Pengjuan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengajuan</li>
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
                <h4 class="modal-title" id="myModalLabel">Tambah Data Pengajuan Sarana</h4>
              </div>
              <div class="modal-body">
                <form action="/siswa/sarana/pengajuan" method="post">
                  {{ csrf_field() }}
                    
                    <input type="hidden" class="form-control" name="nis"  pattern="[0-9]{3,15}" value="{{Auth::user()->username}}" maxlength="9" required title="Nis Siswa Harus 9 Karakter Numerik" placeholder="Masukan NIS Siswa">
                    
                    <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="nama_sarana" pattern=".{5,50}" maxlength="50" required title="Nama Sarana tidak boleh kurang dari 5 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Tipe Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="tipe_sarana" pattern=".{3,50}" maxlength="50" required title="Tipe Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 50 Karakter" placeholder="Masukan Tipe Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Merek Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="merek_sarana" pattern=".{3,50}" maxlength="50" required title="Tipe Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 50 Karakter" placeholder="Masukan merek Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Jumlah Sarana Yang Dibutuhkan : <b style="color:red;">*</b></label>
                    <input type="number" min="0" class="form-control" name="total_sarana" required>
                  </div>
                 
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : <b style="color:red;">*</b></label>
                    <textarea name="keterangan" class="form-control" placeholder="Masukan Keterangan Untuk Bahan Pertimbangan Pengajuan Sarana" name="Keterangan" required></textarea>
                  </div>
                

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
              </div>
              </form>
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
              <b><center><h3 class="box-title">Data Pengajuan Sarana</h3></center></b>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
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
                  <td>{{ $pengajuan->nama_sarana}}</td>
                  <td>{{ $pengajuan->merek_sarana}}</td>
                  <td>{{ $pengajuan->tipe_sarana}}</td>
                  
                  <td><?php 
                  $no++;
                  $date=$pengajuan->tgl ;
                  $formatbaru = date('d F Y ', strtotime($date));
                  echo "$formatbaru";
                  ?></td>
                  <td>{{ $pengajuan->total_sarana }} Sarana</td>
                 <td>
                  <a href="/siswa/sarana/pengajuan/{{ $pengajuan->id }}"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                  @if($pengajuan->pengajuan_status_id==3||$pengajuan->status==0)
                 <a href="/siswa/sarana/pengajuan/{{ $pengajuan->id }}/edit"><button class="btn btn-warning"><i class="fa fa-edit"></i></button> </a>
                 @endif
                 <a href="/siswa/sarana/pengajuan/{{ $pengajuan->id }}/delete" onclick="return confirm('Apakah anda yakin ingin menghapus data pengajuan {{ $pengajuan->nama_sarana}} ?');"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                 </td>

                </tr>
                @endforeach
  
                
                </tbody>
                <tfoot>
                <tr>
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

