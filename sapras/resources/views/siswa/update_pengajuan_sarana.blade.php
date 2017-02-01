@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Pengajuan Sarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Pengajuan Sarana</li>
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
      <div class="row" style="padding:15px">
      <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Update Pengajuan Sarana</h3>
          </div>
          <div class="box-body">
            
            <form action="/guru/sarana/pengajuan/{{ $sarana->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                 
                 
                    <input type="hidden" class="form-control" name="nis"  value="{{Auth::user()->username}}" pattern="[0-9]{3,15}" maxlength="9" required title="Nis Siswa Harus 9 Karakter Numerik" placeholder="Masukan NIS Siswa">
                 
                 <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Sarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" value="{{$sarana->nama_sarana}}"name="nama_sarana" pattern=".{5,50}" maxlength="50" required title="Nama Sarana tidak boleh kurang dari 5 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Tipe Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->tipe_sarana}}" type="text" class="form-control" name="tipe_sarana"  pattern=".{3,50}" maxlength="50" required title="Tipe Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 50 Karakter" placeholder="Masukan Tipe Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Merek Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->merek_sarana}}" type="text" class="form-control" name="merek_sarana" pattern=".{3,50}" maxlength="50" required title="Tipe Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 50 Karakter" placeholder="Masukan merek Sarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Jumlah Sarana Yang Dibutuhkan : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->total_sarana}}" type="number" min="0" class="form-control" name="total_sarana" required>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : <b style="color:red;">*</b></label>
                    <textarea name="keterangan" class="form-control" id="Keterangan" required placeholder="Masukan Keterangan Untuk Bahan Pertimbangan Pengajuan Sarana" >{{$sarana->keterangan}}</textarea>
                  </div>
                
                
              </div>
              <div class="modal-footer">
                
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
                <a href="/siswa/sarana/pengajuan/{{$sarana->id}}"><button class="btn btn-success">Kembali Ke Halaman Detail Pengajuan</button> </a>
              </div>
              
          
          <!-- /.box-body -->
        </div>
      </div>
    
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->


@stop



<!-- Bootstrap 3.3.6 -->

<!-- page script -->


