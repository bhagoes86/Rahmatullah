<?php

/*
 if (Auth::user()->keterangan=="siswa") {
            $link="/siswa";
        }
        elseif (Auth::user()->keterangan=="guru") {
            $link="/guru";
        }
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('home');
});
Route::get('/cari_view', ['uses'=>'UserController@cari_data_view'
,'as'=>'cari']);
Route::post('/cari/','UserController@cari_data');
Auth::routes();
Route::get('home', function () {
    if(Auth::user()->status!=0){
        if (Auth::user()->user_hak_akses_id==3) { return redirect()->route("siswa.home");}
    elseif (Auth::user()->user_hak_akses_id==2) { return redirect()->route("operator.home");}
    elseif (Auth::user()->user_hak_akses_id==1) { return redirect()->route("guru.home");}
    }
    else
    {
        return view('home_nonaktif');
    }
});
Route::get('/siswa/home/',[  
	function(){
		 if (Auth::user()->user_hak_akses_id==3) {
            $nis=Auth::user()->username;
            $pinjaman=DB::table('sarana_pinjams')->leftjoin('saranas','saranas.id','sarana_pinjams.sarana_id')->leftjoin('sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','sarana_pinjam_status.id')->where([['nis',$nis],['status','=',0]])->select('sarana_pinjams.id','sarana_pinjams.waktu_pinjam','sarana_pinjams.waktu_pengembalian','sarana_pinjam_status.status_pinjam','saranas.nama_sarana')->get();
            
            $pengajuan=DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuans.pengajuan_status_id','pengajuan_status.id')->where([['nis',$nis],['status','=',0]])->select()->get();
            $no=1;
            $total_pinjam=DB::table('sarana_pinjams')->
                where([['nis','=',Auth::user()->username],['sarana_pinjam_status_id',1]])->get()->sum('jumlah_pinjam');
            $total_pengajuan=DB::table('pengajuans')->
                where([['nis','=',Auth::user()->username],['pengajuan_status_id','=','1']])->count('id');
            $total_pengajuan_bp=DB::table('pengajuans')->
                where([['nis','=',Auth::user()->username],['status','=','0']])->get()->count('id');
            $total_pinjaman_bp=DB::table('sarana_pinjams')->where([['nis',Auth::user()->username],['status','0']])->get()->count('id');
            $total_bp=$total_pengajuan_bp+$total_pinjaman_bp;
            return view('siswa.home',compact("pinjaman","pengajuan",'no',"total_pinjam","total_bp","total_pengajuan"));
        }
        else{ 
            return view('home_error');
        }
	},'as' => 'siswa.home' ]);
Route::get('/guru/home/',[function(){
        if (Auth::user()->user_hak_akses_id==1) {
            $Sarana=DB::table('saranas')->sum('total_sarana');
            $Prasarana=DB::table('prasaranas')->count('id');
            $pengajuan_total=DB::table('pengajuans')->where('pengajuan_status_id','=','1')->count('id');
            $sarana_pinjam_total=DB::table('sarana_pinjams')->where([['sarana_pinjam_status_id','=','1'],['status','!=','0']])->sum('jumlah_pinjam');
            $sarana_pinjam=DB::table('sarana_pinjams')->leftjoin('sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','sarana_pinjam_status.id')->leftjoin('saranas','saranas.id','sarana_pinjams.sarana_id')->where('status','=','0')->select('sarana_pinjams.*','saranas.nama_sarana','sarana_pinjam_status.status_pinjam')->get();
            $sarana_pengajuan=DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->where('status','=','0')->select('pengajuans.*','pengajuan_status.status_pengajuan')->get();
            $no=1;
            return view('guru.home',compact("Sarana","Prasarana","sarana_pinjam","sarana_pinjam_total","pengajuan_total","sarana_pengajuan","no"));
        }
        else{
            return view('home_error');
        }
    }, 'as' => 'guru.home' ]);

Route::get('/operator/home/',[function(){
        if (Auth::user()->user_hak_akses_id==2) {
            $Sarana=DB::table('saranas')->sum('total_sarana');
            $Prasarana=DB::table('prasaranas')->count('id');
            $pengajuan_total=DB::table('pengajuans')->count('id');
            $sarana_pinjam_total=DB::table('sarana_pinjams')->where([['nip','=',Auth::user()->username],['sarana_pinjam_status_id','=','1'],['status','!=','0']])->sum('jumlah_pinjam');
            $sarana_pinjam=DB::table('sarana_pinjams')->leftjoin('sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','sarana_pinjam_status.id')->leftjoin('saranas','saranas.id','sarana_pinjams.sarana_id')->where('status','=','0')->select('sarana_pinjams.*','saranas.nama_sarana','sarana_pinjam_status.status_pinjam')->get();
            $sarana_pengajuan=DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->where('status','=','0')->select('pengajuans.*','pengajuan_status.status_pengajuan')->get();
            $total_pengajuan_bp=DB::table('pengajuans')->
                where([['status','=','0']])->get()->count('id');
            $total_pinjaman_bp=DB::table('sarana_pinjams')->where([['status','0']])->get()->count('id');
            $no=1;
            return view('operator.home',compact("Sarana","Prasarana","sarana_pinjam","sarana_pinjam_total","pengajuan_total","sarana_pengajuan","no","total_pinjaman_bp","total_pengajuan_bp"));
        }
        else{
            return view('home_error');
        }
    }, 'as' => 'operator.home' ]);

//All Home Route
//Guru Route
Route::get('/guru/sarana/', ['uses' => 'GuruController@olah_sarana', 'as' => 'guru.sarana' ]);
Route::get('/guru/sarana/pinjaman/',['uses'=>'GuruController@olah_sarana_terpinjam','as'=>'guru.sarana.pinjaman']);
Route::get('/guru/sarana/pengajuan/',['uses'=>'SaranaController@olah_pengajuan_sarana','as'=>'guru.sarana.pengajuan']);
Route::get('/guru/prasarana/',['uses'=>'GuruController@olah_prasarana','as'=>'guru.prasarana']);
Route::get('/guru/prasarana/ruangan',['uses'=>'GuruController@olah_prasarana_ruangan','as'=>'guru.prasarana.ruangan']);
Route::get('/guru/user/',['uses'=>'UserController@olah_user', 'as' => 'guru.user']);

//Operator Route
Route::get('/operator/sarana/', ['uses' => 'OperatorController@olah_sarana', 'as' => 'operator.sarana' ]);
Route::get('/operator/sarana/pinjaman/',['uses'=>'OperatorController@olah_sarana_terpinjam','as'=>'operator.sarana.pinjaman']);
Route::get('/operator/sarana/pengajuan/',['uses'=>'OperatorController@olah_pengajuan_sarana','as'=>'operator.sarana.pengajuan']);
Route::get('/operator/prasarana/',['uses'=>'OperatorController@olah_prasarana','as'=>'operator.prasarana']);

//Siswa Route
Route::get('/siswa/sarana/',['uses'=>'SiswaController@olah_sarana','as'=>'siswa.sarana']);
Route::get('/siswa/sarana/pengajuan/',['uses'=>'SiswaController@olah_sarana_pengajuan','as'=>'siswa.sarana.pengajuan']);
Route::get('/siswa/sarana/pinjaman/',['uses'=>'SiswaController@olah_sarana_pinjaman','as'=>'siswa.sarana.pinjaman']);
Route::get('/siswa/prasarana/',['uses'=>'SiswaController@olah_prasarana','as'=>'siswa.prasarana']);

//Update Status Pinjaman Route
//Guru
Route::get('/guru/sarana/pinjaman/{id}/1','SaranaController@update_sarana_pinjaman_1');
Route::get('/guru/sarana/pinjaman/{id}/2','SaranaController@update_sarana_pinjaman_2');
Route::get('/guru/sarana/pinjaman/{id}/3','SaranaController@update_sarana_pinjaman_3');
Route::get('/guru/sarana/pinjaman/{id}/4','SaranaController@update_sarana_pinjaman_4');
//Operator
Route::get('/operator/sarana/pinjaman/{id}/1','SaranaController@update_sarana_pinjaman_1');
Route::get('/operator/sarana/pinjaman/{id}/2','SaranaController@update_sarana_pinjaman_2');
Route::get('/operator/sarana/pinjaman/{id}/3','SaranaController@update_sarana_pinjaman_3');
Route::get('/operator/sarana/pinjaman/{id}/4','SaranaController@update_sarana_pinjaman_4');

//Update Status Pengajuan Route
//guru
Route::get('/guru/sarana/pengajuan/{id}/1','SaranaController@update_sarana_pengajuan_1');
Route::get('/guru/sarana/pengajuan/{id}/3','SaranaController@update_sarana_pengajuan_3');
//operator
Route::get('/operator/sarana/pengajuan/{id}/1','SaranaController@update_sarana_pengajuan_1');
Route::get('/operator/sarana/pengajuan/{id}/3','SaranaController@update_sarana_pengajuan_3');

//All CRUD Route

//sarana start
Route::post('/guru/sarana/','SaranaController@simpan_sarana');
Route::get('/guru/sarana/{id}/','SaranaController@lihat_sarana');
Route::get('/guru/sarana/{id}/edit/',['uses'=>'SaranaController@edit_sarana','as'=>'guru.sarana.update']);
Route::patch('/guru/sarana/{id}/','SaranaController@update_sarana');
Route::get('/guru/sarana/{id}/delete/','SaranaController@delete_sarana');
Route::delete('/guru/sarana/{id}/','SaranaController@delete_sarana');
Route::get('/guru/sarana/downloadExcel/{type}/', 'ExcelController@downloadExcelSarana');
Route::post('/guru/sarana/importExcel/', 'ExcelController@importExcelSarana');
//Sarana end

//sarana terpinjam start
Route::get('/guru/sarana/pinjaman/{id}/','SaranaController@lihat_sarana_terpinjam');
Route::get('/guru/sarana/pinjaman/{id}/edit/','SaranaController@edit_sarana_terpinjam');
Route::patch('/guru/sarana/pinjaman/{id}/','SaranaController@update_sarana_terpinjam');
Route::get('/guru/sarana/pinjaman/{id}/delete/','SaranaController@delete_sarana_tepinjam');
Route::post('/guru/sarana/pinjaman/','SaranaController@simpan_sarana_terpinjam');
Route::get('/guru/sarana/pinjaman/downloadExcel/{type}/', 'ExcelController@downloadExcelSaranaPinjaman');
Route::post('/guru/sarana/pinjaman/importExcel/', 'ExcelController@importExcelSaranaPinjaman');
//sarana terpinjam end

//sarana pengajuan start
Route::get('/guru/sarana/pengajuan/{id}/','SaranaController@lihat_pengajuan_sarana');
Route::get('/guru/sarana/pengajuan/{id}/edit/','SaranaController@edit_pengajuan_sarana');
Route::patch('/guru/sarana/pengajuan/{id}/','SaranaController@update_pengajuan_sarana');
Route::get('/guru/sarana/pengajuan/{id}/delete/','SaranaController@delete_pengajuan_sarana');
Route::post('/guru/sarana/pengajuan/','SaranaController@simpan_pengajuan_sarana');
Route::get('/guru/sarana/pengajuan/downloadExcel/{type}/', 'ExcelController@downloadExcelSaranaPengajuan');
Route::post('/guru/sarana/pengajuan/importExcel/', 'ExcelController@importExcelSaranaPengajuan');
//sarana pengajuan end

//prasarana start
Route::post('/guru/prasarana/','PrasaranaController@simpan_prasarana');
Route::get('/guru/prasarana/{id}/','PrasaranaController@lihat_prasarana');
Route::get('/guru/prasarana/{id}/edit/','PrasaranaController@edit_prasarana');
Route::patch('/guru/prasarana/{id}/','PrasaranaController@update_prasarana');
Route::get('/guru/prasarana/{id}/delete','PrasaranaController@delete_prasarana');
Route::get('/guru/prasarana/downloadExcel/{type}/', 'ExcelController@downloadExcelPrasarana');
Route::post('/guru/prasarana/importExcel/', 'ExcelController@importExcelPrasarana');
//prasarana end

//start prasarana ruangan
Route::post('/guru/prasarana/ruangan/','PrasaranaController@simpan_prasarana_ruangan');
Route::get('/guru/prasarana/ruangan/{id}/','PrasaranaController@lihat_prasarana_ruangan');
Route::get('/guru/prasarana/ruangan/{id}/edit/','PrasaranaController@edit_prasarana_ruangan');
Route::patch('/guru/prasarana/ruangan/{id}/','PrasaranaController@update_prasarana_ruangan');
Route::get('/guru/prasarana/ruangan/{id}/delete','PrasaranaController@delete_prasarana_ruangan');
Route::get('/guru/prasarana/ruangan/downloadExcel/{type}/', 'ExcelController@downloadExcelPrasaranaRuangan');
//end prasarana ruangan


//profill
Route::get('/guru/profil/{id}/','GuruController@lihat_profil');
Route::get('/guru/profil/{id}/edit/','GuruController@edit_profil');
Route::get('/guru/profil/{id}/update/','GuruController@edit_profil');
Route::patch('/guru/profil/{id}/update/','GuruController@update_profil');
Route::get('/guru/sarana_laporan/','GuruController@olah_sarana_laporan');
Route::get('/guru/prasarana_laporan/','GuruController@olah_prasarana_laporan');
//end profil

//operator
//sarana terpinjam start
Route::get('/operator/sarana/pinjaman/{id}/','SaranaController@lihat_sarana_terpinjam');
Route::get('/operator/sarana/pinjaman/{id}/delete/','SaranaController@delete_sarana_tepinjam');
//sarana terpinjam end

//sarana pengajuan start
Route::get('/operator/sarana/pengajuan/{id}/','SaranaController@lihat_pengajuan_sarana');
Route::get('/operator/sarana/pengajuan/{id}/delete/','SaranaController@delete_pengajuan_sarana');
//sarana pengajuan end

//profill
Route::get('/operator/profil/{id}/','OperatorController@lihat_profil');
Route::get('/operator/profil/{id}/edit/','OperatorController@edit_profil');
Route::get('/operator/profil/{id}/update/','OperatorController@edit_profil');
Route::patch('/operator/profil/{id}/update/','Operatorontroller@update_profil');
//user start
Route::post('/guru/user/','UserController@simpan_user');
Route::get('/guru/user/{id}','UserController@lihat_user');
Route::get('/guru/user/{id}/1','UserController@naik_user');
Route::get('/guru/user/{id}/2','UserController@turun_user');
Route::get('/guru/user/{id}/3','UserController@aktif_user');
Route::get('/guru/user/{id}/4','UserController@nonaktif_user');
Route::get('/guru/user/{id}/edit','UserController@edit_user');
Route::patch('/guru/user/{id}/','UserController@update_user');
Route::get('/guru/user/{id}/delete','UserController@delete_user');
//user end


//Siswa
//sarana start
Route::get('/siswa/sarana/{id}/','SaranaController@lihat_sarana');
//sarana end

//sarana pinjaman start
Route::post('/siswa/sarana/pinjaman/','SaranaController@simpan_sarana_terpinjam');
Route::get('/siswa/sarana/pinjaman/{id}/','SaranaController@lihat_sarana_terpinjam');
Route::get('/siswa/sarana/pinjaman/{id}/edit/','SaranaController@edit_sarana_terpinjam');
Route::patch('/siswa/sarana/pinjaman/{id}/','SaranaController@update_sarana_terpinjam');
Route::get('/siswa/sarana/pinjaman/{id}/delete/','SaranaController@delete_sarana_tepinjam');
//sarana pinjaman end

//Sarana Pengajuan Start
Route::post('/siswa/sarana/pengajuan/','SaranaController@simpan_pengajuan_sarana');
Route::get('/siswa/sarana/pengajuan/{id}/','SaranaController@lihat_pengajuan_sarana');
Route::get('/siswa/sarana/pengajuan/{id}/edit/','SaranaController@edit_pengajuan_sarana');
Route::patch('/siswa/sarana/pengajuan/{id}/','SaranaController@update_pengajuan_sarana');
Route::get('/siswa/sarana/pengajuan/{id}/delete/','SaranaController@delete_pengajuan_sarana');
//sarana pengajuan end

//prasarana start
Route::get('/siswa/prasarana/{id}/','PrasaranaController@lihat_prasarana');
//prasarana end

//prorofil
Route::get('/siswa/profil/{id}/','SiswaController@lihat_profil');
Route::get('/siswa/profil/{id}/edit/','SiswaController@edit_profil');
Route::get('/siswa/profil/{id}/update/','SiswaController@edit_profil');
Route::patch('/siswa/profil/{id}/update/','SiswaController@update_profil');


