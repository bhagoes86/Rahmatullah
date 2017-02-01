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
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class OperatorController extends Controller
{
    public function olah_sarana(){
    	$status = Sarana_status::orderBy('status', 'asc')->get();
    	$sarana=DB::table('saranas')->leftjoin('sarana_ruangans','sarana_ruangans.id','saranas.sarana_ruangan_id')->leftjoin('sarana_kondisis','saranas.sarana_kondisi_id','sarana_kondisis.id')->leftjoin('sarana_status','saranas.sarana_status_id','sarana_status.id')->select('saranas.*','sarana_ruangans.ruangan','sarana_status.status','sarana_kondisis.kondisi')->where([['sarana_status_id','=','4']])->get();

        $pinjam=DB::table('sarana_pinjams')->join('saranas' , 'saranas.id' , 'sarana_pinjams.sarana_id')->select(DB::raw('sum(sarana_pinjams.jumlah_pinjam) as total,saranas.id as sarana_id'))->where([['sarana_pinjams.status','!=','0'],['sarana_pinjams.sarana_pinjam_status_id','=','1']])->groupBy('saranas.id')->get();
    	$kondisi = Sarana_kondisi::all();
    	$ruangan = Sarana_ruangan::orderBy('ruangan', 'asc')->get();
        $total_pinjaman=0;
        $no=1;
    return view('operator.olah_sarana', compact("status","kondisi","ruangan", "sarana","pinjam","total_pinjaman","no"));
    }

    public function olah_sarana_terpinjam(){
    	$status =Sarana_pinjam_status::all();
    	$sarana =Sarana::all();
        $pinjam =DB::table('sarana_pinjams')->join('saranas','sarana_pinjams.sarana_id','=','saranas.id')->join('sarana_pinjam_status','sarana_pinjam_status.id','sarana_pinjams.sarana_pinjam_status_id')->select('sarana_pinjams.*','Sarana_pinjam_status.status_pinjam','saranas.nama_sarana','saranas.kode_sarana')->where(function($q) {
          $q->where('sarana_pinjams.nip','=',Auth::user()->username)
            ->orWhere('sarana_pinjams.status','=','0');
      })->get();
        $no=1;
    	return view('operator.olah_sarana_terpinjam' , compact("sarana","status","pinjam","no"));
    }

    public function olah_pengajuan_sarana(){
    $no=1;
    $pengajuan=DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('pengajuans.*','pengajuan_status.status_pengajuan')->where(function($q) {
          $q->where('pengajuans.nip','=',Auth::user()->username)
            ->orWhere('pengajuans.status','=','0');
      })->get();
    return view('operator.olah_pengajuan_sarana',compact('pengajuan','no'));    
    }
    
    public function lihat_profil($id){
        $profil=DB::table('users')->join('ak_guru','users.username','=','ak_guru.nip')->select('users.*','ak_guru.namaguru','ak_guru.status')->where('users.username',$id)->get();
        foreach ($profil as $profil) {
            # code...
        }
        return view('operator.detail_profil', compact("profil"));
    } 
     public function edit_profil($id){
        $profil=DB::table('users')->join('ak_guru','users.username','=','ak_guru.nip')->select('users.*','ak_guru.namaguru','ak_guru.status')->where('users.username',$id)->get();
        foreach ($profil as $profil) { }
        // print_r($profil);
        return view('operator.update_profil',compact("profil"));
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
