@extends('siswa.layout')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Beranda</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
 <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
    
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $total_bp }}</h3>

              <p>Total Permintaan <br> Belum Diproses<br></p>
            </div>
            <div class="icon">
              <i class="fa fa-cog"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $total_pinjam }}</h3>

              <p>Total Sarana <br>Sedang Dipinjam</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $total_pengajuan }}</h3>
              <p>Total Permintaan <br>Pengajuan Dikonfirmasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-check"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        </div>
        
        <div class="row">
        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            <center> <h3 class="box-title"><b>Permintaan Pengajuan Pinjaman  Sarana Belum Diproses</b></h3></center>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table align="center" class="table no-margin">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Pinjaman</th>
                    <th>Nama Sarana</th>
                    <th>Waktu Pengajuan Pinjaman</th>
                    <th>Lama Pinjam</th>
                    <th>Status</th>
                    <th>Operasi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if(!($pinjaman->isEmpty()))
                    @foreach($pinjaman as $p)
                    <tr>
                    <td>{{$no}}</td>
                    <td>{{$p->id}}</td>
                    <td>{{$p->nama_sarana}}</td>
                    <td>
                    <?php 
                    $date=$p->waktu_pinjam ;
                    $formatbaru = date('d F Y ', strtotime($date));
                    echo "$formatbaru";
                    ?>  
                    </td>
                    <td>{{$p->waktu_pengembalian}} Hari</td>
                    <td>{{$p->status_pinjam}}</td>
                    <td><a href="/siswa/sarana/pinjaman/{{$p->id}}/" class="btn btn-success"><i class="fa fa-eye"></i>
                      </a></td>
                    <?php 
                    $no++;
                    ?>
                    </tr>
                    @endforeach
                  @else
                  <tr>
                    <td colspan="7"><center>Tidak Ada Data Tersimpan</center></td>
                  </tr>
                  @endif
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             <!-- <a href="sarana_pinjaman" class="btn btn-sm btn-default btn-flat pull-right">Selengkapnya</a> -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            <center> <h3 class="box-title"><b>Permintaan Pengajuan Sarana Belum Diproses</b></h3></center>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table align="center" class="table no-margin">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Pengajuan</th>
                    <th>Nama Sarana</th>
                    <th>Waktu Pengajuan Sarana</th>
                    <th>Banyak Pengajuan</th>
                    <th>Status</th>
                    <th>Operasi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if(!($pengajuan->isEmpty()))
                  <?php $no=1; ?>
                    @foreach($pengajuan as $p)
                    <tr>
                    <td>{{$no}}</td>
                    <td>{{$p->id}}</td>
                    <td>{{$p->nama_sarana}}</td>
                   
                    <td>
                    <?php 
                    $date=$p->tgl ;
                    $formatbaru = date('d F Y ', strtotime($date));
                    echo "$formatbaru";
                    ?>  
                    </td>
                     <td>{{$p->total_sarana}} Sarana</td>
                    <td>{{$p->status_pengajuan}}</td>
                    <td><a href="/siswa/sarana/pengajuan/{{$p->id}}/" class="btn btn-success"><i class="fa fa-eye"></i>
                      </a></td>
                    <?php 
                    $no++;
                    ?>
                    </tr>
                    @endforeach
                  @else
                  <tr>
                    <td colspan="7"><center>Tidak Ada Data Tersimpan</center></td>
                  </tr>
                  @endif
                  
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             <!-- <a href="sarana_pinjaman" class="btn btn-sm btn-default btn-flat pull-right">Selengkapnya</a> -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        </div>
      
      <!-- /.row (main row) -->

    </section>
@stop

@push('script-head')

<script>
  $(function () {
    $("#satu").DataTable();
    
  });
</script>

  @endpush
