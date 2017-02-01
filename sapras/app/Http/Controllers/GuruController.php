<?php

namespace App\Http\Controllers;

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
class GuruController extends Controller
{
    public function home(){
    	return view('guru.home');
    }

    
    public function olah_sarana(){
    	$status = Sarana_status::orderBy('status', 'asc')->get();
    	$sarana =Sarana::orderBy('id', 'desc')->get();
        $pinjam=DB::table('sarana_pinjams')->join('saranas' , 'saranas.id' , 'sarana_pinjams.sarana_id')->select(DB::raw('sum(sarana_pinjams.jumlah_pinjam) as total,saranas.id as sarana_id'))->where([['sarana_pinjams.status','!=','0'],['sarana_pinjams.sarana_pinjam_status_id','=','1']])->groupBy('saranas.id')->get();
    	$kondisi = Sarana_kondisi::all();
    	$ruangan = Sarana_ruangan::orderBy('ruangan', 'asc')->get();
        $total_pinjaman=0;
        $no=1;
    return view('guru.olah_sarana', compact("status","kondisi","ruangan", "sarana","pinjam","total_pinjaman","no"));
    }

    public function olah_sarana_terpinjam(){
    	$status =Sarana_pinjam_status::all();
    	$sarana =Sarana::all();
        $pinjam =DB::table('sarana_pinjams')->join('saranas','sarana_pinjams.sarana_id','=','saranas.id')->join('sarana_pinjam_status','sarana_pinjam_status.id','sarana_pinjams.sarana_pinjam_status_id')->select('sarana_pinjams.*','Sarana_pinjam_status.status_pinjam','saranas.nama_sarana','saranas.kode_sarana')->get();
         $no=1;
    	return view('guru.olah_sarana_terpinjam' , compact("sarana","status","pinjam","no"));
    }

    public function olah_sarana_laporan(){
    	
    	return view('guru.olah_sarana_laporan');
    }


    public function olah_prasarana(){
    	$status = Prasarana_status::all();
    	$kondisi = Prasarana_kondisi::all();
        $prasarana = DB::table('prasaranas')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')->select('prasaranas.*','prasarana_status.prasarana_status','prasarana_kondisis.kondisi','ak_guru.*')->get();
        $no=1;
    	return view('guru.olah_prasarana' , compact("status","kondisi","prasarana","no"));
    }

    public function olah_prasarana_ruangan(){
        $ruangan=DB::table('sarana_ruangans')->leftjoin('prasaranas','prasaranas.id','sarana_ruangans.prasarana_id')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->select('sarana_ruangans.*','prasaranas.nama_prasarana','prasaranas.kode_prasarana','prasarana_kondisis.kondisi','prasarana_status.prasarana_status')->get();
       
        $prasarana=Prasarana::where('id','!=','36')->get();
        $no=1;
        return view('guru.olah_prasarana_ruangan' , compact("ruangan","no","prasarana"));
    }

    public function olah_prasarana_laporan(){
    	
    	return view('guru.olah_prasarana_laporan');
    }

    public function lihat_profil($id){
        $profil=DB::table('users')->join('ak_guru','users.username','=','ak_guru.nip')->select('users.*','ak_guru.namaguru','ak_guru.status')->where('users.username',$id)->get();
        foreach ($profil as $profil) {
            # code...
        }
        return view('guru.detail_profil', compact("profil"));
    } 
     public function edit_profil($id){
        $profil=DB::table('users')->join('ak_guru','users.username','=','ak_guru.nip')->select('users.*','ak_guru.namaguru','ak_guru.status')->where('users.username',$id)->get();
        foreach ($profil as $profil) { }
        // print_r($profil);
        return view('guru.update_profil',compact("profil"));
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
}
