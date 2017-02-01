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
            <h3 class="box-title">Update Sarana</h3>
          </div>
          <div class="box-body">
            
            <form action="/guru/sarana/{{ $sarana->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kode Sarana : <b style="color:red;">*</b></label>
                    <input type="text" value="{{$sarana->kode_sarana}}"class="form-control" name="kode_sarana" pattern=".{3,20}" maxlength="20" required title="Kode Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 20 Karakter " >
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->nama_sarana}}" type="text" class="form-control" name="nama_sarana" pattern=".{5,50}" maxlength="50" required title="Nama Sarana tidak boleh kurang dari 5 karakter & tidak lebih dari 50 Karakter " >
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nomer Register Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->no_regis}}" type="text" class="form-control" name="no_regis" pattern=".{3,15}" maxlength="15"  required title="Nomer Register Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 15 Karakter " >
                  </div>
                  
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Merek/Tipe Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->merk_sarana}}"  type="text" class="form-control" name="merk_sarana" attern=".{3,50}" maxlength="50" required title="Merek/Tipe Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 50 Karakter ">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Bahan Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->bahan}}"  type="text" class="form-control" name="bahan" pattern=".{3,15}" maxlength="15"  required title="Bahan Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 25 Karakter " >
                  </div>
                   <div class="form-group">
                    <label for="recipient-name" class="control-label">Tahun Pembelian : <b style="color:red;">*</b></label>
                    <div class="input-group date" data-provide="datepicker">
                      <input type="text" value="{{$sarana->tahun_pembelian}}" class="form-control" name="tahun_pembelian" required title="Tahun pembelian Sarana Harus Diisi Dengan Benar" >
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Asal Usul Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->asal_sarana}}"  type="text" class="form-control" name="asal_sarana" pattern=".{3,15}" maxlength="15"  required title="Asal Usul Sarana tidak boleh kurang dari 3 karakter & tidak lebih dari 15 Karakter ">
                  </div>
                   <div class="form-group">
                    <label for="recipient-name" class="control-label">Harga Satuan : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->harga_sarana}}" name="harga_sarana" type="number" class="form-control" id="replyNumber" min="0" step="1000" required title="Harga Sarana Dalam Satuan Rupiah" />
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Total Sarana : <b style="color:red;">*</b></label>
                    <input value="{{$sarana->total_sarana}}" name="total_sarana" type="number" class="form-control"  min="0" step="1" required/> 
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Status Sarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="sarana_status_id" required/>
                       @foreach ($status as $status) 
                       @if($status->id==$sarana->sarana_status_id)
                       <option value='{{ $status->id }}' selected="selected">
                       {{ $status->status}} 
                       </option>
                       @else
                       <option value='{{ $status->id}}'>
                       {{ $status->status}} 
                       </option>
                       @endif
                       
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Kondisi Sarana : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      
                      <select class="form-control" name="sarana_kondisi_id" required/>
                       @foreach ($kondisi as $kondisi) 
                       @if($kondisi->id==$sarana->sarana_kondisi_id)
                        <option value='{{ $kondisi->id }}' selected="selected">
                       {{ $kondisi->kondisi}} 
                       </option>
                       @else
                        <option value='{{ $kondisi->id }}'>
                       {{ $kondisi->kondisi}} 
                       </option>
                       @endif
                       @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Ruangan  : <b style="color:red;">*</b></label>
                    <div class="form-group">
                      <select class="form-control" name="sarana_ruangan_id">
                       @foreach ($ruangan as $ruangan) 
                       @if($ruangan->id==$sarana->sarana_ruangan_id)
                       <option value='{{ $ruangan->id }}' selected="selected" required/>
                       {{ $ruangan->ruangan}} 
                       </option>
                       @else
                       <option value='{{ $ruangan->id }}'>
                       {{ $ruangan->ruangan}} 
                       </option>
                       @endif
                       @endforeach
                      
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Keterangan : </label>
                    <textarea class="form-control" id="Keterangan" name="keterangan">{{$sarana->keterangan}} </textarea>
                  </div>
                
              </div>
              <div class="modal-footer">
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
                <a href="/guru/sarana/{{ $sarana->id }}/"><button class="btn btn-success">Kembali Ke Halaman Detail</button></a> 
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


