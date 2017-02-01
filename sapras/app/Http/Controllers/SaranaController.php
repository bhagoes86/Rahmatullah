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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Redirect;

class SaranaController extends Controller
{
    public function simpan_sarana(Request $request)
    {
        $this->validate($request,[
        'kode_sarana'=>'required|unique:saranas',
        'nama_sarana'=>'required',
        'no_regis'=>'required',
        'merk_sarana'=>'required',
        'bahan'=>'required',
        'tahun_pembelian'=>'required',
        'asal_sarana'=>'required',
        'harga_sarana'=>'required',
        'total_sarana'=>'required',
        'sarana_status_id'=>'required',
        'sarana_kondisi_id'=>'required',
        'sarana_ruangan_id'=>'required',
        ]);
   
        $total=$request->harga_sarana*$request->total_sarana;
        $sarana = new Sarana;
            $sarana->nip = Auth::user()->username;
            $sarana->kode_sarana = $request->kode_sarana;
            $sarana->nama_sarana = $request->nama_sarana;
            $sarana->no_regis = $request->no_regis;
            $sarana->merk_sarana = $request->merk_sarana;
            $sarana->bahan = $request->bahan;
            $sarana->tahun_pembelian = $request->tahun_pembelian;
            $sarana->asal_sarana = $request->asal_sarana;
            $sarana->harga_sarana = $request->harga_sarana;
            $sarana->total_sarana= $request->total_sarana;
            $sarana->total_harga = $total;
            $sarana->sarana_status_id = $request->sarana_status_id;
            $sarana->sarana_kondisi_id = $request->sarana_kondisi_id;
            $sarana->sarana_ruangan_id = $request->sarana_ruangan_id;
            $sarana->keterangan = $request->keterangan;
        $sarana->save();
        $request->session()->flash('alert-success', 'Sarana Telah Berhasil Ditambah');    
        return redirect()->route("guru.sarana");
    }

    public function delete_sarana(Request $request,Sarana $id){
        Sarana::where('id',$id['id'])->delete();
        $request->session()->flash('alert-warning', 'Sarana Telah Berhasil Dihapus');    
        return redirect()->route("guru.sarana");
    }

    public function edit_sarana(Sarana $id){
        $status = Sarana_status::all();
        $kondisi = Sarana_kondisi::all();
        $ruangan = Sarana_ruangan::all();
        $sarana=$id;
        return view('guru.update_sarana',compact("sarana","ruangan","kondisi","status"));
    }

    public function lihat_sarana(Sarana $id){
        if (Auth::user()->user_hak_akses_id==1) {
            $sarana=DB::table('saranas')->leftjoin('sarana_ruangans','sarana_ruangans.id','saranas.sarana_ruangan_id')->leftjoin('sarana_kondisis','saranas.sarana_kondisi_id','sarana_kondisis.id')->leftjoin('sarana_status','saranas.sarana_status_id','sarana_status.id')->where('saranas.id','=',$id['id'])->select('saranas.*','sarana_ruangans.ruangan','sarana_status.status','sarana_kondisis.kondisi')->get();
       
            return view('guru.detail_sarana',compact("sarana"));    
        }
        elseif (Auth::user()->user_hak_akses_id==2) {
            
        }
        elseif (Auth::user()->user_hak_akses_id==3) {
            $pinjam=DB::table('sarana_pinjams')->join('saranas' , 'sarana_pinjams.sarana_id' , '=' , 'saranas.id')->select(DB::raw('sum(sarana_pinjams.jumlah_pinjam) as total'))->where([['sarana_pinjams.status','!=','0'],['sarana_pinjams.sarana_id','=',$id['id']]])->get();
             $sarana=DB::table('saranas')->leftjoin('sarana_ruangans','sarana_ruangans.id','saranas.sarana_ruangan_id')->leftjoin('sarana_kondisis','saranas.sarana_kondisi_id','sarana_kondisis.id')->leftjoin('sarana_status','saranas.sarana_status_id','sarana_status.id')->where('saranas.id','=',$id['id'])->select('saranas.*','sarana_ruangans.ruangan','sarana_status.status','sarana_kondisis.kondisi')->get();
             foreach ($pinjam as $pinjam) {
                  # code...
              } 
            return view('siswa.detail_sarana',compact("pinjam","sarana")); 
        }
        
    }

    public function update_sarana(Request $request,Sarana $id){
        $sarana=Sarana::where([['kode_sarana','=',$request['kode_sarana']],['id','!=',$id['id']]])->count('id');
        $s=Sarana::where([['kode_sarana','=',$id['kode_sarana']],['id','=',$id['id']]])->get();
        echo "$sarana";
        if($sarana==0){
            $id->update($request->all());
                    $total_harga=$request['harga_sarana']*$request['total_sarana'];
                    Sarana::where('id',$id['id'])
                    ->update([
                        'total_harga'=>$total_harga,
                        'sarana_ruangan_id'=>$request['sarana_ruangan_id'],
                        'sarana_kondisi_id'=>$request['sarana_kondisi_id'],
                        'sarana_status_id'=>$request['sarana_status_id']
                        ]);
                    $request->session()->flash('alert-success', 'Sarana Telah Berhasil Dirubah'); 
                     return back();  
        }
        elseif ($sarana==1) {
             $request->session()->flash('alert-danger', 'Sarana Gagal Dirubah, Kode Sarana Tidak Boleh Sama dengan Kode Sarana yang lainnya');
                     return back();
        }
      
    }

   	 public function simpan_sarana_terpinjam(Request $request){
			$input = $request->all();
			if (Auth::user()->user_hak_akses_id==3) {
               $sarana = Sarana::where('id','=',$request['sarana_id'])->select('total_sarana')->get();
            $sarana_pinjam = Sarana_pinjam::where([['sarana_id','=',$request['sarana_id']],['sarana_pinjam_status_id','=','1']])->sum('jumlah_pinjam');
            //print_r($sarana_pinjam);
            foreach ($sarana as $sarana) {}
            //$sarana['total_sarana']-=$sarana_pinjam[''];
            $total=$sarana['total_sarana']-$sarana_pinjam;

			$this->validate($request,[
                'nis'=>'required|exists:ak_siswa,nis', 
                'sarana_id'=>'required|exists:saranas,id',
               'jumlah_pinjam'=>'required|integer|max:'.$total,
                'waktu_pengembalian'=>'required',
                'keterangan'=>'required',  
            ]);
            $pinjam = new Sarana_pinjam;
                $pinjam->nis = $request->nis;
                $pinjam->sarana_id = $request->sarana_id;
                $pinjam->jumlah_pinjam = $request->jumlah_pinjam;
                $pinjam->Sarana_pinjam_status_id = 3;
                $pinjam->waktu_pengembalian = $request->waktu_pengembalian;
                $pinjam->keterangan = $request->keterangan;
            $pinjam->save();
            $request->session()->flash('alert-success', 'Pinjaman Sarana Telah Berhasil Ditambah');
            return redirect()->route("siswa.sarana.pinjaman");
	        }

	        elseif (Auth::user()->user_hak_akses_id==1) {
            $sarana = Sarana::where('id','=',$request['sarana_id'])->select('total_sarana')->get();
            $sarana_pinjam = Sarana_pinjam::where([['sarana_id','=',$request['sarana_id']],['sarana_pinjam_status_id','=','1']])->sum('jumlah_pinjam');
            //print_r($sarana_pinjam);
            foreach ($sarana as $sarana) {}
            //$sarana['total_sarana']-=$sarana_pinjam[''];
            $total=$sarana['total_sarana']-$sarana_pinjam;
            $this->validate($request,[
                'nis'=>'required|exists:ak_siswa,nis', 
                'sarana_id'=>'required|exists:saranas,id',
                'jumlah_pinjam'=>'required|integer|max:'.$total,
                'waktu_pengembalian'=>'required',   
            ]);
            $pinjam = new Sarana_pinjam;
                $pinjam->nip = Auth::user()->username;
                $pinjam->nis = $request->nis;
                $pinjam->sarana_id = $request->sarana_id;
                $pinjam->jumlah_pinjam = $request->jumlah_pinjam;
                $pinjam->Sarana_pinjam_status_id = 1;
                $pinjam->waktu_pengembalian = $request->waktu_pengembalian;
                $pinjam->status = 1;
                $pinjam->keterangan = $request->keterangan;
            $pinjam->save();
            $request->session()->flash('alert-success', 'Pinjaman Sarana Telah Berhasil Ditambah');
            return redirect()->route("guru.sarana.pinjaman");
	        }			 
		}

		public function delete_sarana_tepinjam($id,Request $request){
        if(Auth::user()->user_hak_akses_id==1){
            Sarana_pinjam::where('id',$id)->delete();
        }
        elseif(Auth::user()->user_hak_akses_id==2){
                Sarana_pinjam::where('id',$id)->delete();
        }
        elseif(Auth::user()->user_hak_akses_id==3){
            Sarana_pinjam::where([['id',$id],['nis',Auth::user()->username]])->delete();
        }

        $request->session()->flash('alert-danger', 'Sarana Pinjaman Telah Berhasil Dihapus');  
    	return back();
    	}

  		public function lihat_sarana_terpinjam(Sarana_pinjam $id){
        if(Auth::user()->user_hak_akses_id==1){
            $sarana=DB::table('sarana_pinjams')->join('saranas','sarana_pinjams.sarana_id','saranas.id')->join('sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','sarana_pinjam_status.id')->where('sarana_pinjams.id','=',$id['id'])->select('sarana_pinjams.*','saranas.nama_sarana','Sarana_pinjam_status.status_pinjam')->get();
            $user=DB::table('ak_siswa')->join('Sarana_pinjams','Sarana_pinjams.nis','ak_siswa.nis')->select('ak_siswa.*')->where('ak_siswa.nis','=',$id['nis'])->limit(1)->get();
            foreach ($user as $user) {}
            return view('guru.detail_sarana_pinjaman',compact("sarana","user"));    
        }
        elseif (Auth::user()->user_hak_akses_id==2) {
             $sarana=DB::table('sarana_pinjams')->join('saranas','sarana_pinjams.sarana_id','saranas.id')->join('sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','sarana_pinjam_status.id')->where('sarana_pinjams.id','=',$id['id'])->select('sarana_pinjams.*','saranas.nama_sarana','Sarana_pinjam_status.status_pinjam')->get();
            $user=DB::table('ak_siswa')->join('Sarana_pinjams','Sarana_pinjams.nis','ak_siswa.nis')->select('ak_siswa.*')->where('ak_siswa.nis','=',$id['nis'])->limit(1)->get();
            foreach ($user as $user) {}
            return view('operator.detail_sarana_pinjaman',compact("sarana","user"));    
        }
        elseif (Auth::user()->user_hak_akses_id==3) {
           $sarana=DB::table('sarana_pinjams')->join('saranas','sarana_pinjams.sarana_id','saranas.id')->join('sarana_pinjam_status','sarana_pinjams.sarana_pinjam_status_id','sarana_pinjam_status.id')->where('sarana_pinjams.id','=',$id['id'])->select('sarana_pinjams.*','saranas.nama_sarana','Sarana_pinjam_status.status_pinjam')->get();
            $user=DB::table('ak_siswa')->join('Sarana_pinjams','Sarana_pinjams.nis','ak_siswa.nis')->select('ak_siswa.*')->where('ak_siswa.nis','=',$id['nis'])->limit(1)->get();
            foreach ($user as $user) {}
            return view('siswa.detail_pinjaman_sarana',compact("sarana","user"));
        }
    	
    	}	

    	public function edit_sarana_terpinjam(Sarana_pinjam $id){
        if (Auth::user()->user_hak_akses_id==1) {
            $status = Sarana_pinjam_status::where('id','!=','3')->get();
            $sarana = Sarana::all();
            $ruangan = Sarana_ruangan::all();
            $pinjam=$id;
            return view('guru.update_sarana_pinjaman',compact("sarana","ruangan","pinjam","status"));
        }
        elseif (Auth::user()->user_hak_akses_id==2) {}
        elseif (Auth::user()->user_hak_akses_id==3) {
            $status = Sarana_pinjam_status::all();
            $sarana = Sarana::all();
            $ruangan = Sarana_ruangan::all();
            $pinjam=$id;
            return view('siswa.update_pinjaman_sarana',compact("sarana","ruangan","pinjam","status"));
        }
    	
        }   

    public function update_sarana_terpinjam(Request $request,$id){
         $sarana = Sarana::where('id','=',$request['sarana_id'])->select('total_sarana')->get();
        $sarana_pinjam = Sarana_pinjam::where([['sarana_id','=',$request['sarana_id']],['sarana_pinjam_status_id','=','1']])->sum('jumlah_pinjam');
         $s = Sarana_pinjam::where('id','=',$id)->sum('jumlah_pinjam');
        foreach ($sarana as $sarana) {}
        $total=$sarana['total_sarana']-$sarana_pinjam;//+$s;
         $this->validate($request,[
                'nis'=>'required|exists:ak_siswa,nis', 
                'sarana_id'=>'required|exists:saranas,id',
                'jumlah_pinjam'=>'required|integer|max:'.$total,
            ]);
        $request->session()->flash('alert-success', 'Pinjaman Sarana Telah Berhasil Dirubah');
    	sarana_pinjam::where('id','=',$id)->update([
            'nis'=>$request['nis'],'sarana_id'=>$request['sarana_id'],'jumlah_pinjam'=>$request['jumlah_pinjam'],'waktu_pengembalian'=>$request['waktu_pengembalian'],'keterangan'=>$request['keterangan'],'sarana_pinjam_status_id'=>$request['sarana_pinjam_status_id']
            ]
            );
        echo $request['sarana_id'];
    	return back();
    }

    public function update_sarana_pinjaman_1(Request $request,Sarana_pinjam $id){
        $request->session()->flash('alert-success', 'Pinjaman Sarana Telah Berhasil Dikonfirmasi');
    	Sarana_pinjam::where('id',$id['id'])->update(['sarana_pinjam_status_id'=>'1','status'=>'1','nip'=>Auth::user()->username]);
    	return back();
    	}
    public function update_sarana_pinjaman_2(Request $request,Sarana_pinjam $id){
        $request->session()->flash('alert-warning', 'Status Pinjaman Sarana Telah Berhasil Dirubah');
    	Sarana_pinjam::where('id',$id['id'])->update(['sarana_pinjam_status_id'=>'2','status'=>'1','nip'=>Auth::user()->username]);
    	return back();
    	}
    public function update_sarana_pinjaman_3(Request $request,Sarana_pinjam $id){
        $request->session()->flash('alert-danger', 'pinjaman Sarana Telah Berhasil Ditolak');
    	Sarana_pinjam::where('id',$id['id'])->update(['sarana_pinjam_status_id'=>'4','status'=>'1','nip'=>Auth::user()->username]);
    	return back();
    	}
    public function update_sarana_pinjaman_4(Request $request,Sarana_pinjam $id){
        $request->session()->flash('alert-info', 'Pinjaman Sarana Telah Berhasil Dirubah');
        Sarana_pinjam::where('id',$id['id'])->update(['sarana_pinjam_status_id'=>'5','status'=>'1','nip'=>Auth::user()->username]);
        return back();
        }   	
/*
    	public function simpan_sarana(Request $request){
    	$input = $request->all();
    	$nip_guru = Auth::user()->username;
    	$total_harga=$input['harga']*$input['total'];

    	Sarana::create([
    		'nip' => $nip_guru ,
    		'kode_sarana' => $input['kode_sarana'],
			'nama_sarana' => $input['nama_sarana'],
			'no_regis' => $input['no_regis'],
			'merk_sarana' => $input['merk'],
			'bahan' => $input['bahan'],
			'tahun_pembelian' => $input['tahun'],
			'asal_sarana' => $input['asal'],
			'harga_sarana' => $input['harga'],
			'total_sarana'=> $input['total'],
			'total_harga' => $total_harga,
			'status_sarana' => $input['status'],
			'kondisi_sarana' => $input['kondisi'],
			'ruangan' => $input['ruangan'],
			'keterangan' => $input['keterangan']
    		]);
    
    		
		return redirect()->back();
    }
*/
    
     
    public function olah_pengajuan_sarana(){
    $no=1;
    $pengajuan=DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('pengajuans.*','pengajuan_status.status_pengajuan')->get();
    return view('guru.olah_pengajuan_sarana',compact('pengajuan','no'));    
    }
    public function delete_pengajuan_sarana(Request $request,$id){
        if(Auth::user()->user_hak_akses_id==1){
             Pengajuan::where('id',$id)->delete();
        }
        elseif(Auth::user()->user_hak_akses_id==2){
            Pengajuan::where('id',$id)->delete();
        }
        elseif(Auth::user()->user_hak_akses_id==3){
             Pengajuan::where([['id',$id],['nis',Auth::user()->username]])->delete();
        }
        $request->session()->flash('alert-danger', 'Pengajuan Sarana  Telah Berhasil Dihapus');  
       

        return back();
    }

    public function lihat_pengajuan_sarana(Pengajuan $id){
        if(Auth::user()->user_hak_akses_id==1){
             $sarana=DB::table('pengajuans')->join('ak_siswa','ak_siswa.nis','pengajuans.nis')->join('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('ak_siswa.*','pengajuans.*','pengajuan_status.status_pengajuan')->where('pengajuans.id','=',$id['id'])->get();
        foreach ($sarana as $sarana) {
            # code...
        }
        return view('guru.detail_pengajuan_sarana',compact("sarana","user"));    
        }
        elseif(Auth::user()->user_hak_akses_id==2){
             $sarana=DB::table('pengajuans')->join('ak_siswa','ak_siswa.nis','pengajuans.nis')->join('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('ak_siswa.*','pengajuans.*','pengajuan_status.status_pengajuan')->where('pengajuans.id','=',$id['id'])->get();
        foreach ($sarana as $sarana) {
            # code...
        }
        return view('operator.detail_pengajuan_sarana',compact("sarana","user"));    
        }
        elseif(Auth::user()->user_hak_akses_id==3){
             $sarana=DB::table('pengajuans')->join('ak_siswa','ak_siswa.nis','pengajuans.nis')->join('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('ak_siswa.*','pengajuans.*','pengajuan_status.status_pengajuan')->where([['pengajuans.id','=',$id['id']],['pengajuans.nis','=',Auth::user()->username]])->get();
                foreach ($sarana as $sarana) {
                    # code...
                }
                return view('siswa.detail_pengajuan_sarana',compact("sarana","user"));    
        }
        
    }
    public function edit_pengajuan_sarana(Pengajuan $id){
        if(Auth::user()->user_hak_akses_id==1){
            $sarana=$id;
        $user=DB::table('ak_siswa')->join('pengajuans','pengajuans.nis','ak_siswa.nis')->select('ak_siswa.*')->where('ak_siswa.nis','=',$sarana['nis'])->limit(1)->get();
        $status=Pengajuan_status::where('id','!=','3')->get();
        foreach ($user as $user) {}
        return view('guru.update_pengajuan_sarana',compact("sarana","status"));       
        }
        elseif(Auth::user()->user_hak_akses_id==2){}
        elseif(Auth::user()->user_hak_akses_id==3){
        $sarana=$id;
        $user=DB::table('ak_siswa')->join('pengajuans','pengajuans.nis','ak_siswa.nis')->select('ak_siswa.*')->where('ak_siswa.nis','=',$sarana['nis'])->limit(1)->get();
        $status=Pengajuan_status::all();
        foreach ($user as $user) {}
        return view('siswa.update_pengajuan_sarana',compact("sarana","status"));       
        }
        
    }
    public function update_pengajuan_sarana(Request $request,Pengajuan $id){
        $this->validate($request,[
                'nis'=>'required|exists:ak_siswa,nis', 
            ]);
        $id->update($request->all());
        Pengajuan::where('id',$id['id'])->update(['status'=>'1','nip'=>Auth::user()->username]);
        $request->session()->flash('alert-success', 'Pengajuan Sarana Telah Berhasil Dirubah');
        return back();
    }
    public function simpan_pengajuan_sarana(Request $request){
            if (Auth::user()->user_hak_akses_id==1) {
            $this->validate($request,[
                'nis'=>'required|exists:ak_siswa,nis', 
            ]);
            $pengajuan = new Pengajuan;
                $pengajuan->nip = Auth::user()->username;
                $pengajuan->nis = $request->nis;
                $pengajuan->nama_sarana = $request->nama_sarana;
                $pengajuan->merek_sarana = $request->merek_sarana;
                $pengajuan->tipe_sarana = $request->tipe_sarana;
                $pengajuan->total_sarana = $request->total_sarana;
                $pengajuan->pengajuan_status_id = 1;
                $pengajuan->status = 1;
                $pengajuan->keterangan = $request->keterangan;
            $pengajuan->save();
            $request->session()->flash('alert-success', 'Pengajuan Sarana Telah Berhasil Ditambah');
            return redirect()->route("guru.sarana.pengajuan");
            }
            elseif (Auth::user()->user_hak_akses_id==2) {
            # code...
            }
            elseif (Auth::user()->user_hak_akses_id==3) {
            $this->validate($request,[
                'nis'=>'required|exists:ak_siswa,nis', 
            ]);
            $pengajuan = new Pengajuan;
                $pengajuan->nis = $request->nis;
                $pengajuan->nama_sarana = $request->nama_sarana;
                $pengajuan->merek_sarana = $request->merek_sarana;
                $pengajuan->tipe_sarana = $request->tipe_sarana;
                $pengajuan->total_sarana = $request->total_sarana;
                $pengajuan->pengajuan_status_id = 3;
                $pengajuan->status = 0;
                $pengajuan->keterangan = $request->keterangan;
            $pengajuan->save();
            $request->session()->flash('alert-success', 'Pengajuan Sarana Telah Berhasil Ditambah');
            return redirect()->route("siswa.sarana.pengajuan");
            }
            
            
    
    }
    public function update_sarana_pengajuan_1(Request $request,Pengajuan $id){
        Pengajuan::where('id',$id['id'])->update(['pengajuan_status_id'=>'1','status'=>'1','nip'=>Auth::user()->username]);
        $request->session()->flash('alert-success', 'Pengajaun Sarana Telah Berhasil Dikonfirmasi');
        return back();
        }
    public function update_sarana_pengajuan_3(Request $request,Pengajuan $id){
        Pengajuan::where('id',$id['id'])->update(['pengajuan_status_id'=>'2','status'=>'1','nip'=>Auth::user()->username]);
        $request->session()->flash('alert-danger', 'Pengajaun Sarana Telah Berhasil Ditolak');
        return back();
        }
}
