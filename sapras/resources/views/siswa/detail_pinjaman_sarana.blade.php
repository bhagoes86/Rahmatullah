@extends('siswa.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Data Sarana Terpinjam</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Sarana Terpinjam</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
    
      
      </div>
      <div class="row" style="padding:15px">
      <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Detail Sarana Terpinjam</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
            @foreach($sarana as $sarana)
              <tr>
              <td>NIS</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nis }}</td>
              <tr>
              <td>Nama Siswa</td>
              <td><b> : </b></td>
              <td>{{ $user->namasiswa }}</td>
              </tr>
              <td>Jurusan Siswa</td>
              <td><b> : </b></td>
              <td>{{ $user->jurusan }}</td>
              </tr>
              <td>Nama Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nama_sarana }}</td>
              </tr>
              <tr>
              <td>Waktu Peminjaman</td>
              <td><b> : </b></td>
              <td>
              <?php 
                    $date=$sarana->waktu_pinjam ;
                    $formatbaru = date('d F Y ', strtotime($date));
                    echo "$formatbaru";
              ?>
              
              </td>
              </tr>
              <tr>
              <td>Lama Pinjam</td>
              <td><b> : </b></td>
              <td>{{ $sarana->waktu_pengembalian }} Hari</td>
              </tr>
              <tr>
              <td>Total Pinjam</td>
              <td><b> : </b></td>
              <td>{{ $sarana->jumlah_pinjam }} Barang</td>
              </tr>
              <tr>
              <tr>
              <td>Status Pinjaman</td>
              <td><b> : </b></td>
              <td>{{ $sarana->status_pinjam }}</td>
              </tr>
              <tr>
              <td>Keterangan Pinjaman</td>
              <td><b> : </b></td>
              <td>
              @if(empty($sarana->keterangan))
              -
              @else
              {{ $sarana->keterangan }}  
              @endif
              
              </td>
              </tr>
              
              <tr>
                
                <td colspan="3">
                <a href="/siswa/sarana/pinjaman/"><button class="btn btn-success">Kembali Ke Halaman Olah Pinjaman</button> </a>
                @if($sarana->sarana_pinjam_status_id==3)
                <a href="/siswa/sarana/pinjaman/{{ $sarana->id }}/edit"><button class="btn btn-primary">Update Data</button> </a>
                @endif
              </td>
              </tr>
              @endforeach
            </table>
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


