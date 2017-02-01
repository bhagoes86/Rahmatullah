@extends('guru.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Olah Data Ruangan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Olah Data Ruangan</li>
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
            <h3 class="box-title">Update  Ruangan</h3>
          </div>
          <div class="box-body">
            
            <form action="/guru/prasarana/ruangan/{{ $ruangan->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}            
                 <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Ruangan : <b style="color:red;">*</b></label>
                    <input type="text" class="form-control" name="ruangan"  value="{{$ruangan->ruangan}}"pattern=".{2,50}" maxlength="50" required title="Nama Ruangan tidak boleh kurang dari 2 karakter & tidak lebih dari 50 Karakter " placeholder="Masukan nama Ruangan" >
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Tempat Ruangan : <b style="color:red;">*</b></label>
                    <select class="form-control" name="prasarana_id" required>
                    @foreach($prasarana as $prasarana)
                    @if($ruangan->prasarana_id==$prasarana->id)
                    <option value="{{$prasarana->id}}" selected="selected">
                    {{$prasarana->nama_prasarana}}</option>
                    @else
                    <option value="{{$prasarana->id}}">
                    {{$prasarana->nama_prasarana}}</option>
                    @endif
                    @endforeach
                    </select>
                  </div>
            
              </div>
              <div class="modal-footer">
                
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
                 <a href="/guru/prasarana/ruangan/{{ $ruangan->id }}/"><button class="btn btn-success">Kembali Ke Halaman Detail</button></a> 
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


