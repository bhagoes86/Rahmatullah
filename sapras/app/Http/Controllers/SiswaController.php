<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Sarana;
use App\Sarana_status;
use App\Sarana_ruangan;
use App\Sarana_kondisi;
use App\Pengajuan;
use App\Pengajuan_status;
use App\Sarana_pinjam;
use App\Sarana_pinjam_status;
use App\Prasarana;
use App\Prasarana_status;
use App\Prasarana_kondisi;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class SiswaController extends Controller
{
     public function olah_sarana(){

    	$sarana=DB::table('saranas')->leftjoin('sarana_ruangans','sarana_ruangans.id','saranas.sarana_ruangan_id')->leftjoin('sarana_kondisis','saranas.sarana_kondisi_id','sarana_kondisis.id')->leftjoin('sarana_status','saranas.sarana_status_id','sarana_status.id')->select('saranas.*','sarana_ruangans.ruangan','sarana_status.status','sarana_kondisis.kondisi')->get();
       
    	$pinjam=DB::table('sarana_pinjams')->join('saranas' , 'sarana_pinjams.sarana_id' , '=' , 'saranas.id')->select(DB::raw('sum(sarana_pinjams.jumlah_pinjam) as total,sarana_pinjams.sarana_id'))->where([['sarana_pinjams.status','!=','0'],['sarana_pinjams.sarana_pinjam_status_id','=','1']])->groupBy('sarana_pinjams.sarana_id')->get();
        $no=1;
    	return view('siswa.olah_sarana', compact("no", "sarana","pinjam"));
    }
    public function olah_sarana_pinjaman(){

       $status =Sarana_pinjam_status::all();
        $sarana =Sarana::where([['sarana_status_id','=','4']])->get();
        $pinjam =DB::table('sarana_pinjams')->leftjoin('saranas','sarana_pinjams.sarana_id','=','saranas.id')->leftjoin('Sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','Sarana_pinjam_status.id')->where('sarana_pinjams.nis','=',Auth::user()->username)->select('sarana_pinjams.*','saranas.nama_sarana','saranas.kode_sarana','sarana_pinjam_status.status_pinjam')->get();
        $no=1;
        return view('siswa.olah_sarana_pinjaman', compact("no", "sarana","pinjam",'status'));
    }


    public function olah_sarana_pengajuan(){
    $pengajuan=DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('pengajuans.*','pengajuan_status.status_pengajuan')->where('nis','=',Auth::user()->username)->get();
    $no=1;
    return view('siswa.olah_pengajuan_sarana', compact("no", "pengajuan"));
    }
    

    public function olah_prasarana(){
        $status = Prasarana_status::all();
        $kondisi = Prasarana_kondisi::all();
        $prasarana = DB::table('prasaranas')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')->select('prasaranas.*','prasarana_status.prasarana_status','prasarana_kondisis.kondisi','ak_guru.*')->get();
        $no=1;
        return view('siswa.olah_prasarana' , compact("status","kondisi","prasarana","no"));
    }

    public function lihat_sarana(Sarana $id){
        $sarana=$id;
        $pinjam=DB::table('sarana_pinjams')->join('saranas' , 'saranas.nama_sarana' , '=' , 'sarana_pinjams.nama_sarana')->select(DB::raw('sum(sarana_pinjams.jumlah_pinjam) as total,sarana_pinjams.nama_sarana'))->groupBy('sarana_pinjams.nama_sarana')->get();
        return view('siswa.detail_sarana',compact("sarana","pinjam"));
    }

    public function lihat_profil($id){
        $profil=DB::table('users')->join('ak_siswa','users.username','=','ak_siswa.nis')->select('users.*','ak_siswa.nisn','ak_siswa.namasiswa','ak_siswa.jurusan','ak_siswa.status')->where('users.username',$id)->get();
        
        return view('siswa.detail_profil', compact("profil"));
    } 
     public function edit_profil($id){
        $profil=DB::table('users')->join('ak_siswa','users.username','=','ak_siswa.nis')->select('users.*','ak_siswa.nisn','ak_siswa.namasiswa','ak_siswa.jurusan','ak_siswa.status')->where('users.username',$id)->get();
         
        return view('siswa.update_profil',compact("profil"));
    }
    public function update_profil(Request $request,$id){
        $this->validate($request,[
        'password' => 'required|min:6|confirmed',
        ]);
        $profil=User::where('username',$id)->get();
        $input=$request->all();
        print_r($input);    
        foreach ($profil as $profil) {
            if (Hash::check($input['password1'], $profil['password']))
            {
                $password=bcrypt($input['password']);
                User::where('username',$id)
                ->update(['password'=>$password]);
                $request->session()->flash('alert-success', 'Profil Telah Berhasil Dirubah');    
                return back();
               }
            
            else
            {
                $request->session()->flash('alert-danger', 'Password yang dimasukan tidak cocok');    
                return back();
            }
        }
        
    }

    public function olah_sarana_show(Sarana $id){
        $sarana=$id;
    	return view('guru.detail_sarana',compact("sarana"));
    }

    public function olah_sarana_update(Sarana $id){
        $sarana=$id;
        return view('guru.update_sarana',compact("sarana"));
    }
    

    public function olah_sarana_laporan(){
    	
    	return view('guru.olah_sarana_laporan');
    }


   
}
