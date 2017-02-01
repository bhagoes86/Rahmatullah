@extends('operator.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Detail Profil</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Profil</li>
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
            <h3 class="box-title">Detail Profil</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
            
              <tr>
              <td>ID</td>
              <td><b> : </b></td>
              <td>{{ $profil->id }}</td>
              </tr>
              <tr>
              <td>NIP</td>
              <td><b> : </b></td>
              <td>{{ $profil->username }}</td>
              </tr>
              
              <tr>
              <td>Nama Lengkap</td>
              <td><b> : </b></td>
              <td>{{ $profil->namaguru }}</td>
              </tr>
          
              <tr>
              <td>Level User</td>
              <td><b> : </b></td>
              <td>{{ $profil->name }}</td>
              </tr>
              <tr>
              <td>Status </td>
              <td><b> : </b></td>
              <td>{{ $profil->status }}</td>
              </tr>
              
              <tr>
              
                <td colspan="3">
                 <a href="/operator/profil/{{$profil->username}}/edit" class="btn btn-success ">Update Data
                  </a>
              </td>
              </tr>
            </table>
            
          </div>
          <!-- /.box-body -->
        </div>
      </div>
</section>
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->


@stop



<!-- Bootstrap 3.3.6 -->

<!-- page script -->






