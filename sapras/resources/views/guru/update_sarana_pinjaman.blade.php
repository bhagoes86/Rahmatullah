@extends('guru.layout')

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
      <div class="row" style="padding:15px">
      <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Update Sarana Terpinjam</h3>
          </div>
          <div class="box-body">
            
            <form action="/guru/sarana/pinjaman/{{ $pinjam->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <div class="form-group">
                    <label for="recipient-name" class="control-label">NIS Siswa : <b style="color:red;">*</b></label></label>
                    <input type="text" class="form-control" value="{{$pinjam->nis}}" name="nis" required pattern="[0-9]{3,15}" maxlength="9" required title="Nis Siswa Harus 9 Karakter Numerik" placeholder="Masukan NIS Siswa">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Nama Sarana : <b style="color:red;">*</b></label></label>
                    <select name="sarana_id" class="form-control" required>
                    @foreach($sarana as $sarana)
                    @if($pinjam->sarana_id==$sarana->id)
                    <option value="{{ $sarana->id }}" selected="selected">{{ $sarana->nama_sarana}}</option>
                    @else
                    <option value="{{ $sarana->id }}">{{ $sarana->nama_sarana}}</option> 
                    @endif
                    @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Total Barang : <b style="color:red;">*</b></label></label>
                    <input value="{{ $pinjam->jumlah_pinjam}}"type="number" class="form-control" name="jumlah_pinjam" id="replyNumber" min="0" step="1" required/>
                  </div>
                  <div class="form-group">
                      <label>Lama Pinjam Sarana : <b style="color:red;">*</b></label></label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input value="{{$pinjam->waktu_pengembalian}}"type="number" class="form-control" name="waktu_pengembalian" id="replyNumber" min="0" max="7" step="1" required/>
                          <!--<input type="text" class="form-control pull-right" id="datepicker" name="lama">
                      
                     /.input group -->
                     </div>
                  </div>
                 <div class="form-group">
                    <label for="recipient-name" class="
                    control-label">Status Pinjaman : <b style="color:red;">*</b></label></label>
                    <select name="sarana_pinjam_status_id" class="form-control" required>

                    @foreach($status as $status)
                     @if($pinjam->sarana_pinjam_status_id==$status->id)
                    <option value="{{ $status->id }}" selected="selected">{{ $status->status_pinjam}}</option>
                    @else
                    <option value="{{ $status->id }}">{{ $status->status_pinjam}}</option>
                    @endif
                    @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan :</label>
                    <textarea name="keterangan" class="form-control" id="Keterangan">{{$pinjam->keterangan}}</textarea>
                  </div>
                
                
              </div>
              <div class="modal-footer">
                
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
                <a href="/guru/sarana/pinjaman/{{ $pinjam->id }}/"><button class="btn btn-success">Kembali Ke Halaman Detail</button> </a>
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


