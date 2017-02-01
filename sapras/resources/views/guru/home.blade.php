@extends('guru.layout')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
 <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $Sarana }}</h3>

              <p>Total Sarana <br> Terdata<br></p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="/guru/sarana" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $Prasarana }}</h3>

              <p>Total  Prasarana <br> Terdata </p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="/guru/prasarana" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $sarana_pinjam_total }}</h3>

              <p>Total <br>Sarana Terpinjam</p>
            </div>
            <div class="icon">
              <i class="fa fa-pie-chart"></i>
            </div>
            <a href="/guru/sarana/pinjaman" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $pengajuan_total }}</h3>

              <p>Permintaan Pengajuan <br> Sarana Terkonfirmasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-plus-square"></i>
            </div>
            <a href="/guru/sarana/pengajuan" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            <center> <h3 class="box-title"><b>Permintaan Pengajuan Pinjaman Terbaru Sarana</b></h3></center>

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
                    <th>Nama Sarana</th>
                    <th>Status</th>
                    <th>NIS Siswa</th>
                    <th>Waktu Pinjam</th>
                    <th>Lama Pinjam</th>
                    <th>Operasi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if(!($sarana_pinjam->isEmpty()))

                  @foreach($sarana_pinjam as $pinjam)
                   <tr>
                    <td>{{$no}}</a></td>
                    <td>{{$pinjam->sarana_id}}</td>
                    <td><span class="label label-warning">{{$pinjam->status_pinjam}}</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$pinjam->nis}}</div>
                    </td>
                    <td>
                    <?php 
                    $no++;
                    $date=$pinjam->waktu_pinjam ;
                    $formatbaru = date('d F Y ', strtotime($date));
                    echo "$formatbaru";
                    ?>
                        
                    </td>
                    <td>
                        {{$pinjam->waktu_pengembalian}} hari
                    </td>
                    <td>
                      <a href="/guru/sarana/pinjaman/{{$pinjam->id}}/" class="btn btn-success"><i class="fa fa-eye"></i>
                      </a>
                    </td>
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
        

        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
             <center> <h3 class="box-title"><b>Permintaan Pengajuan Sarana Terbaru</b></h3></center>

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
                    <th>Nama Sarana</th>
                    <th>Status</th>
                    <th>NIS Siswa</th>
                    <th>Waktu Pengajuan</th>
                    <th>Banyak Pengajuan</th>
                    <th>Operasi</th>
                  </tr>
                  </thead>
                  <tbody >
                  @if(!($sarana_pengajuan->isEmpty()))
                  <?php $no=1;?>
                  @foreach($sarana_pengajuan as $pengajuan)
                   <tr >
                    <td>{{$no}}</a></td>
                    <td>{{$pengajuan->nama_sarana}}</td>
                    <td><span class="label label-warning">{{$pengajuan->status_pengajuan}}</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$pengajuan->nis}}</div>
                    </td>
                    <td><?php 
                        $date=$pengajuan->tgl ;
                        $formatbaru = date('d F Y ', strtotime($date));
                        echo "$formatbaru";
                        $no++;
                        
                        ?>
                    </td>
                    <td>{{$pengajuan->total_sarana}} Sarana</td>
                    <td>
                      <a href="/guru/sarana/pengajuan/{{$pengajuan->id}}/" class="btn btn-success">
                      <i class="fa fa-eye"></i>
                      </a>
                    </td>
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