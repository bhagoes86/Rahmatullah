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
    
      
      </div>
      <div class="row" style="padding:15px">
      <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Detail Sarana</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
            @foreach($sarana as $sarana)
              <tr>
              <td width="45%">NIP </td>
              <td width="5%"><b> : </b></td>
              <td width="50%">{{ $sarana->nip }}</td>
              </tr>
              <tr>
              <td>Kode Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->kode_sarana }}</td>
              </tr>
              <tr>
              <td>Nama Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nama_sarana }}</td>
              </tr>
              <tr>
              <td>No Registrasi Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->no_regis }}</td>
              </tr>
              <tr>
              <td>Merk/Tipe Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->merk_sarana }}</td>
              </tr>
              <tr>
              <td>Bahan</td>
              <td><b> : </b></td>
              <td>{{ $sarana->bahan }}</td>
              </tr>
              <tr>
              <td>NIP</td>
              <td><b> : </b></td>
              <td>{{ $sarana->nip }}</td>
              </tr>
              <tr>
              <td>Asal Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->asal_sarana }}</td>
              </tr>
              <tr>
              <td>Tahun Pembelian</td>
              <td><b> : </b></td>
              <td> 
              <?php 
                    $date=$sarana->tahun_pembelian ;
                    $formatbaru = date('d F Y ', strtotime($date));
                    echo "$formatbaru";
              ?>
              </td>
              </tr>
              <tr>
              <td>Total Sarana</td>
              <td><b> : </b></td>
              
              <td>{{ $sarana->total_sarana }}</td>
              </tr>
              <tr>
              <td>Harga Satuan</td>
              <td><b> : </b></td>
              <td>
              <?php $number = $sarana->harga_sarana;
              $money_number = number_format($number,2,',','.');
              ?>Rp.{{ $money_number }},- 
              </td>
              </tr>
              <tr>
              <td>Total Harga</td>
              <td><b> : </b></td>
              <td> <?php $number = $sarana->total_harga;
              $money_number = number_format($number,2,',','.');
              ?>Rp.{{ $money_number }},- </td>
              </tr>
              <tr>
              <td>Kondisi Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->kondisi }}</td>
              </tr>
              <tr>
              <td>Status Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->status }}</td>
              </tr>
              <tr>
              <td>Ruangan Sarana</td>
              <td><b> : </b></td>
              <td>{{ $sarana->ruangan }}</td>
              </tr>
              <tr>
              <td>Keterangan Sarana</td>
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
              
                <td colspan="3"><a href="/guru/sarana/"><button class="btn btn-success">Kembali Ke Halaman Olah Sarana</button> </a><a href="/guru/sarana/{{ $sarana->id }}/edit/"><button class="btn btn-primary">Update Data</button> </a>
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


