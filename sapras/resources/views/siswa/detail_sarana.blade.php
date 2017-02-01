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
        <li class="active">Olah Data Prasarana</li>
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
            <h3 class="box-title">Update  Prasarana</h3>
          </div>
          <div class="box-body">
            
            <form action="/guru/prasarana/{{ $prasarana->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
            
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kode Prasarana : <b style="color:red;">*</b></label>
                    <input  type="text" class="form-control" name="kode_prasarana" value="{{$prasarana->kode_prasarana}}" pattern=".{3,20}" maxlength="20" required title="Kode Prasarana tidak boleh kurang dari 3 karakter & tidak lebih dari 20 Karakter " placeholder="Masukan Kode prasarana">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Prasarana : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="nama_prasarana" value="{{$prasarana->nama_prasarana}}" pattern=".{5,50}" maxlength="50" required title="Nama Prasarana tidak boleh kurang dari 5 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Prasarana" >
                  </div>
                  
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Status Prasarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="prasarana_status_id" required>
                       @foreach ($status as $status) 
                       @if($prasarana->prasarana_status_id==$status->id)
                       <option value='{{ $status->id }}' selected="selected">
                       {{ $status->prasarana_status }} 
                       </option>
                       @else
                       <option value='{{ $status->id }}'>
                       {{ $status->prasarana_status }} 
                       </option>
                       @endif
                       
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Kondisi Prasarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      
                      <select class="form-control" name="prasarana_kondisi_id" required>
                       @foreach ($kondisi as $kondisi) 
                       @if($prasarana->prasarana_kondisi_id==$kondisi->id)
                       <option value='{{ $kondisi->id }}' selected="selected">{{ $kondisi->kondisi }} 
                       </option>
                       @else
                       <option value='{{ $kondisi->id }}'>{{ $kondisi->kondisi }} 
                       </option>
                       @endif
                       
                       
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">NIP Penanggung Jawab : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="pj_prasarana" value="{{$prasarana->pj_prasarana}}"pattern="[0-9]{3,25}" maxlength="25" required title="NIP Penanggung Jawab Harus  Karakter Numerik" placeholder="Masukan NIP Penanggung Jawab">
                  </div>
                  <div class="form-group">
                      <label>Waktu Diresmikan : <b style="color:red;">*</b></label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input value="{{$prasarana->tahun_peresmian}}" name="tahun_peresmian" type="text" class="form-control pull-right" id="datepicker" required>
                      </div>
                      <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : </label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukan Keterangan Prasarana" >{{$prasarana->keterangan}}</textarea>
                  </div>
                 
              </div>
              <div class="modal-footer">
                
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
                 <a href="/guru/prasarana/{{ $prasarana->id }}/"><button class="btn btn-success">Kembali Ke Halaman Detail</button></a> 
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


