<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sarana;
use App\Sarana_ruangan;
use App\Sarana_pinjam;
use App\Prasarana;
use App\Prasarana_kondisi;
use App\Prasarana_status;
use App\Ruangan;
Use Auth;
use DB;
class PrasaranaController extends Controller
{
     public function simpan_prasarana(Request $request){
		$this->validate($request,[
        'kode_prasarana'=>'required|unique:prasaranas',
        'nama_prasarana'=>'required',
        'pj_prasarana'=>'required|exists:ak_guru,nip',
        'tahun_peresmian'=>'required',
        'prasarana_status_id'=>'required',
        'prasarana_kondisi_id'=>'required',
        ]);
   
        $prasarana = new Prasarana;
            $prasarana->nip = Auth::user()->username;
            $prasarana->kode_prasarana = $request->kode_prasarana;
            $prasarana->nama_prasarana = $request->nama_prasarana;
            $prasarana->pj_prasarana = $request->pj_prasarana;
            $prasarana->tahun_peresmian = $request->tahun_peresmian;
            $prasarana->prasarana_status_id = $request->prasarana_status_id;
            $prasarana->prasarana_kondisi_id = $request->prasarana_kondisi_id;
            $prasarana->keterangan = $request->keterangan;
        $prasarana->save();
        $request->session()->flash('alert-success', 'Sarana Telah Berhasil Ditambah');    
        return redirect()->route("guru.prasarana");
		}

		public function delete_prasarana($id){
        $request->session()->flash('alert-danger', 'Prasarana Telah Berhasil Dihapus');
        Sarana_ruangan::where('prasarana_id',$id)->delete();
    	Prasarana::where('id',$id)->delete();
    	return back();
    	}

    	 public function edit_prasarana(Prasarana $id){
    	$status = Prasarana_status::all();
    	$kondisi = Prasarana_kondisi::all();
        $prasarana = $id;
    	return view('guru.update_prasarana' , compact("status","kondisi","prasarana"));
    	
    	}
    	public function update_prasarana(Request $request,Prasarana $id){
    	$prasarana=Prasarana::where([['kode_prasarana','=',$request['kode_prasarana']],['id','!=',$id['id']]])->count('id');
        $s=Prasarana::where([['kode_prasarana','=',$id['kode_prasarana']],['id','=',$id['id']]])->get();
        if($prasarana==0){
            $this->validate($request,[
            'pj_prasarana'=>'required|exists:ak_guru,nip',
            ]);
             Prasarana::where('id','=',$id['id'])->update([
                        'kode_prasarana'=>$request['kode_prasarana'],
                        'nama_prasarana'=>$request['nama_prasarana'],
                        'pj_prasarana'=>$request['pj_prasarana'],
                        'tahun_peresmian'=>$request['tahun_peresmian'],
                        'keterangan'=>$request['keterangan'],
                        'nip'=>Auth::user()->username,
                        'prasarana_status_id'=>$request['prasarana_status_id'],
                        'prasarana_kondisi_id'=>$request['prasarana_kondisi_id']
                        ]);
                    
                    $request->session()->flash('alert-success', 'Prasarana Telah Berhasil Dirubah');    
                     return back();  
        }
        elseif ($prasarana==1) {
              $request->session()->flash('alert-danger', 'Prasarana Gagal Dirubah, Kode Prasarana Tidak Boleh Sama dengan Kode Prasarana yang lainnya');    
                     return back();
        }
        
    	
    	}

    	public function lihat_prasarana(Prasarana $id){
        if(Auth::user()->user_hak_akses_id==1){
        $prasarana = DB::table('prasaranas')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')->select('prasaranas.*','prasarana_status.prasarana_status','prasarana_kondisis.kondisi','ak_guru.*')->where('prasaranas.id','=',$id['id'])->get();
        foreach ($prasarana as $prasarana) {
            # code...
        }
        return view('guru.detail_prasarana',compact("prasarana"));   
        }
        elseif(Auth::user()->user_hak_akses_id==2){}
        elseif(Auth::user()->user_hak_akses_id==3){
        $prasarana = DB::table('prasaranas')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')->select('prasaranas.*','prasarana_status.prasarana_status','prasarana_kondisis.kondisi','ak_guru.*')->where('prasaranas.id','=',$id['id'])->get();
        foreach ($prasarana as $prasarana) {
            # code...
        }
        return view('siswa.detail_prasarana',compact("prasarana"));
        }    
    	
    	}

        public function simpan_prasarana_ruangan(Request $request){
        $s = new Sarana_ruangan;
            $s->ruangan = $request['ruangan'];
            $s->prasarana_id=$request['prasarana_id'];
        $s->save();
        $request->session()->flash('alert-success', 'Ruangan Telah Berhasil Ditambah');    
        return redirect()->route("guru.prasarana.ruangan");
        }
        public function delete_prasarana_ruangan(Request $request,$id){
            $request->session()->flash('alert-danger', 'Ruangan Telah Berhasil Dihapus');
            Sarana::where('sarana_ruangan_id','=',$id)->update(['sarana_ruangan_id'=>'3']);
            Sarana_ruangan::where('id',$id)->delete();
            return back();
        }
        public function edit_prasarana_ruangan(Sarana_ruangan $id){
        $ruangan=$id;
        $prasarana=Prasarana::where('id','!=','36')->get();
        $no=1;
        return view('guru.update_prasarana_ruangan' , compact("ruangan","prasarana"));
        }
        public function update_prasarana_ruangan(Request $request,Sarana_ruangan $id){
            Sarana_ruangan::where('id','=',$id['id'])->update(['ruangan'=>$request['ruangan'],'prasarana_id'=>$request['prasarana_id']]);
            $request->session()->flash('alert-success', 'Ruangan Telah Berhasil Dirubah');    
            return back();  
        }
        public function lihat_prasarana_ruangan(Sarana_ruangan $id){
            $prasarana = DB::table('sarana_ruangans')->leftjoin('prasaranas','prasaranas.id','sarana_ruangans.prasarana_id')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')->select('Sarana_ruangans.*','prasaranas.nama_prasarana','prasaranas.pj_prasarana','prasaranas.kode_prasarana','prasarana_status.prasarana_status','prasarana_kondisis.kondisi','ak_guru.namaguru')->where('sarana_ruangans.id','=',$id['id'])->get();
        foreach ($prasarana as $prasarana) {
            # code...
        }
        return view('guru.detail_prasarana_ruangan',compact("prasarana"));   
        }
}
