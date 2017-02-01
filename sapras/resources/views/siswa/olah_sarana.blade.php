@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Data Sarana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Sarana</li>
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
      <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
             <center> <h3 class="box-title">Data Sarana </center></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="satu" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Sarana</th>
                  <th>Nama Sarana</th>
                  <th>Jumlah Sarana Tersedia</th>
                  <th>Kondisi Sarana</th>
                  <th>Status Sarana</th>
                  <th>Operasi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sarana as $sarana)
                 @foreach($pinjam as $p)
                           @if($p->sarana_id==$sarana->id)
                            <?php
                            $sarana->total_sarana=$sarana->total_sarana-$p->total;
                            ?>
                            @elseif($p->sarana_id!=$sarana->id)
                            <?php
                            continue;
                            ?>
                          @endif
                  @endforeach
                 
                  <tr>
                  <td>{{ $no}} </td>
                  <td>{{ $sarana->kode_sarana}} </td>
                  <td>{{ $sarana->nama_sarana}}</td>
                  <td>{{ $sarana->total_sarana}}</td>
                  <td>{{ $sarana->kondisi}}</td>
                  <td>{{ $sarana->status}}</td>
                   <?php $no++; ?>
                  <td>
                  <a href="/siswa/sarana/{{$sarana->id}}" title="Lihat Sarana"><button class="btn btn-success "><i class="fa fa-eye"></i>
                  </button></a>
                  @if($sarana->sarana_status_id==4)
                  <button title="Pinjam Sarana" data-toggle="modal" data-target="#myModal{{ $sarana->id}}" type="button" class="btn btn-warning "><i class="fa fa-share"></i>
                  </button>
                  <div class="modal fade" id="myModal{{ $sarana->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span arioa-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel{{ $sarana->kode_sarana}}">Pinjam Sarana</h4>
                      </div>
                      <div class="modal-body">
                        <form action="/siswa/sarana/pinjaman/" method="post">
                        {{ csrf_field() }}
                        <div class="form-grup">
                        <label for="recipient-name" class="control-label">Kode Sarana : </label>
                        <input  type="hidden" name="nis" value="{{ Auth::user()->username }}">
                        <input class="form-control"  style="width:100%" disabled="disabled"  type="text"  value="{{ $sarana->kode_sarana}}" name="kode_sarana">
                        </div>

                        <div class="form-grup">
                        <label for="recipient-name" class="control-label">Nama Sarana : </label> 
                        <input  style="width:100%"disabled="disabled" type="text" class="form-control" value="{{ $sarana->nama_sarana}}"  name="kode_sarana">
                        <input type="hidden" value="{{ $sarana->id }}" name="sarana_id">
                        </div>
                        <div class="form-grup">
                          <label for="recipient-name" class="control-label">Total Sarana : <b style="color:red;">*</b></label>
                          <input  type="number" class="form-control" style="width:100%" name="jumlah_pinjam" id="replyNumber" min="0" max="{{ $sarana->total_sarana }}" step="1" />
                        </div>
                       <div class="form-group" style="width:100%">
                      <label class="control-label">Lama Pinjam Sarana (Hari) : <b style="color:red;">*</b></label>
                      <br>
                      <div class="input-group date" style="width:100%">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input style="width:100%" type="number" class="form-control" name="waktu_pengembalian" id="replyNumber" min="0" max="7" step="1" required/>
                      </div>
                      </div> <br/>
                       <div class="form-group" style="width:100%">
                        <label for="message-text" class="control-label">Keterangan : <b style="color:red;">*</b></label>

                        <textarea style="width:100%" name="keterangan" class="form-control" id="keterangan" required></textarea>
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
                  @else
                  <?php 
                  continue;
                  ?>
                  @endif
                  
                  </td>
                </tr>
                @endforeach
                
                
                </tbody>
                <tfoot>
                <th>No</th>
                  <th>Kode Sarana</th>
                  <th>Nama Sarana</th>
                  <th>Jumlah Sarana Tersedia</th>
                  <th>Kondisi Sarana</th>
                   <th>Status Sarana</th>
                  <th>Operasi</th>
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
