
@extends('siswa.layout')



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
        <button data-toggle="modal" data-target="#myModal" style="min-width:100px;margin:5px;padding:5px;" type="button" class="btn btn-success pull-left"><i style="font-size:50px"class="fa fa-plus-square"></i><p> Tambah Data</p>
          </button>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Pinjaman Sarana</h4>
              </div>
              <div class="modal-body">
                <form action="/guru/sarana/pinjaman/" method="post">
                  {{ csrf_field() }}
                    
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Nama Sarana : <b style="color:red;">*</b></label>
                    <input type="hidden" value="{{Auth::user()->username}}" class="form-control" name="nis"  pattern="[0-9]{3,15}" maxlength="9" required title="Nis Siswa Harus 9 Karakter Numerik" placeholder="Masukan NIS Siswa">
                    <select name="sarana_id" class="form-control" required>
                    @foreach($sarana as $sarana)
                    <option value="{{ $sarana->id }}">{{ $sarana->nama_sarana}}</option>
                    @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Total Barang : <b style="color:red;">*</b></label>
                    <input type="number" class="form-control" name="jumlah_pinjam" id="replyNumber" min="0" step="1" required />
                  </div>
                  <div class="form-group">
                      <label class="control-label">Lama Pinjam Sarana (Hari) : <b style="color:red;">*</b></label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="number" class="form-control" name="waktu_pengembalian" id="replyNumber" min="0" max="7" step="1" required/>
                     </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : </label>
                    <textarea name="keterangan" class="form-control" id="Keterangan"></textarea>
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
              <h3 class="box-title">Data Permintaan Pinjamana Sarana</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No </th>
                  <th>Kode Sarana</th>
                  <th>Nama Sarana</th>
                  <th>Jumlah Pinjam</th>
          
                  <th>Lama Pinjam</th>
                  <th>Status Peminjaman</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pinjam as $pinjam)

                <tr>
                  <td>{{ $no}}</td>
                  <td>{{ $pinjam->kode_sarana}}</td>
                  <td>{{ $pinjam->nama_sarana}}</td>
                  <td>{{ $pinjam->jumlah_pinjam}} Sarana
                  </td>
                  
                  <td>{{ $pinjam->waktu_pengembalian}} Hari</td>
                 <td>{{ $pinjam->status_pinjam}}</td>
                 <td>
                 <a href="/siswa/sarana/pinjaman/{{ $pinjam->id }}/"><button class="btn btn-success"><i class="fa fa-eye"></i></button> </a>
                 @if($pinjam->sarana_pinjam_status_id==3)
                 <a href="/siswa/sarana/pinjaman/{{ $pinjam->id }}/edit/"><button class="btn btn-warning"><i class="fa fa-edit"></i></button> </a>
                 @endif
                 <a href="/siswa/sarana/pinjaman/{{ $pinjam->id }}/delete/" onclick="return confirm('Apakah anda yakin ingin menghapus data peminjaman {{ $pinjam->nama_sarana}} ?');"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                 </td>
                </tr>
                <?php $no++;?>
                @endforeach
                
                
                </tbody>
                <tfoot>
                <tr>
                  <th>No Sarana</th>
                  <th>Kode Sarana</th>
                  <th>Nama Sarana</th>
                 
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

