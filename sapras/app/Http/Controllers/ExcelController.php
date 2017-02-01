<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Sarana_status;
use App\Sarana_kondisi;
use App\Sarana_Ruangan;
use App\Sarana;
use App\Prasarana;
use App\Sarana_pinjam;
use DB;
use Excel;
use Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
class ExcelController extends Controller
{
    public function downloadExcelSarana($type)
	{
		$q=DB::table('saranas')
		->select('saranas.id',
			'saranas.nip',
			'saranas.kode_sarana',
			'saranas.nama_sarana',
			'saranas.no_regis',
			'saranas.merk_sarana',
			'saranas.bahan',
			'saranas.asal_sarana',
			'saranas.tahun_pembelian',
			'saranas.total_sarana',
			'saranas.harga_sarana',
			'saranas.total_harga',
			'sarana_ruangans.ruangan',
			'sarana_status.status',
			'sarana_kondisis.kondisi',
			'saranas.keterangan')
		->Leftjoin('sarana_ruangans','sarana_ruangans.id','saranas.sarana_ruangan_id')
		->Leftjoin('sarana_kondisis','saranas.sarana_kondisi_id','sarana_kondisis.id')
		->Leftjoin('sarana_status','saranas.sarana_status_id','sarana_status.id')
		->get();	
		$r=$q->toArray();
		$data = json_decode(json_encode($r), True);
		
		return Excel::create('Data Sarana', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
		
        
	}

	public function importExcelSarana(Request $request)
	{
		$sarana=Sarana::all();
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $value) {
						if (!empty($value['kode_sarana'])) {
							$insert = array (
							'nip' => Auth::user()->username,
				    		'kode_sarana' => $value['kode_sarana'],
							'nama_sarana' => $value['nama_sarana'],
							'no_regis' => $value['no_regis'],
							'merk_sarana' => $value['merk_sarana'],
							'bahan' => $value['bahan'],
							'tahun_pembelian' => $value['tahun_pembelian'],
							'asal_sarana' => $value['asal_sarana'],
							'harga_sarana' => $value['harga_sarana'],
							'total_sarana'=> $value['total_sarana'],
							'total_harga' => $value['total_harga'],
							'sarana_status_id' => $value['sarana_status_id'],
							'sarana_kondisi_id' => $value['sarana_kondisi_id'],
							'sarana_ruangan_id' => $value['sarana_ruangan_id'],
							'keterangan' => $value['keterangan']
							);
							Sarana::insertIgnore($insert);
						}
						else{
							continue;
						}	
				}

				foreach ($data as $value) {
					foreach ($sarana as $s ) {
						if ($s['kode_sarana']==$value['kode_sarana']&&!empty($value['kode_sarana'])) {
							Sarana::where('kode_sarana',$value['kode_sarana'])
    						->update(
    							[
							'nip' => Auth::user()->username,
				    		'kode_sarana' => $value['kode_sarana'],
							'nama_sarana' => $value['nama_sarana'],
							'no_regis' => $value['no_regis'],
							'merk_sarana' => $value['merk_sarana'],
							'bahan' => $value['bahan'],
							'tahun_pembelian' => $value['tahun_pembelian'],
							'asal_sarana' => $value['asal_sarana'],
							'harga_sarana' => $value['harga_sarana'],
							'total_sarana'=> $value['total_sarana'],
							'total_harga' => $value['total_harga'],
							'sarana_status_id' => $value['sarana_status_id'],
							'sarana_kondisi_id' => $value['sarana_kondisi_id'],
							'sarana_ruangan_id' => $value['sarana_ruangan_id'],
							'keterangan' => $value['keterangan']
								]
    							);
							
						}
						else{
							continue;
						}
					}
				}
				if(!empty($insert)){
				
				}
			}
		}
		$request->session()->flash('alert-success', 'Import Sarana Telah Berhasil Terupload');    
        return redirect()->route("guru.sarana");
	}

	public function downloadExcelSaranaPinjaman($type)
	{
		$q = DB::table('sarana_pinjams')->leftjoin('sarana_pinjam_status','sarana_pinjam_status.id','sarana_pinjams.sarana_pinjam_status_id')->leftjoin('saranas','saranas.id','=','sarana_pinjams.sarana_id')->select('sarana_pinjams.nis','sarana_pinjams.nip','saranas.kode_sarana','saranas.nama_sarana','sarana_pinjams.jumlah_pinjam','sarana_pinjams.waktu_pinjam','sarana_pinjams.waktu_pengembalian','sarana_pinjam_status.status_pinjam','sarana_pinjams.keterangan')->get();//where('sarana_pinjams.sarana_pinjam_status_id','=','3')->
		
		$r=$q->toArray();
		$data = json_decode(json_encode($r), True);
		
		return Excel::create('Data Pinjaman Sarana', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
		
	}

	public function importExcelSaranaPinjaman(Request $request)
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $value) {
						if (!empty($value['nis'])) {
							$sarana = Sarana::where('id','=',$value['sarana_id'])->select('total_sarana')->get();
					        $sarana_pinjam = Sarana_pinjam::where('sarana_id','=',$value['sarana_id'])->sum('jumlah_pinjam');
					        foreach ($sarana as $sarana) {}
					        $total=$sarana['total_sarana']-$sarana_pinjam;
					    	$siswa=DB::table('ak_siswa')->where('nis','=',$value['nis'])->select('nis')->get();
					    	if(!($siswa->isEmpty())){
					    		if($value['jumlah_pinjam']<=$total){
						    	$insert = array (
								'nip' => Auth::user()->username,
					    		'nis' => $value['nis'],
								'sarana_id' => $value['sarana_id'],
								'jumlah_pinjam' => $value['jumlah_pinjam'],
								'sarana_pinjam_status_id' => $value['sarana_pinjam_status_id'],
								'status' => 1,
								'waktu_pinjam' => $value['waktu_pinjam'],
								'waktu_pengembalian' => $value['waktu_pengembalian'],
								'keterangan' => $value['keterangan']
								);	
								DB::table('sarana_pinjams')->insert($insert);
								echo "4";
								}
								else{
								$error[] = ['no' => $value->no];
								echo "3";
								}	
					    	}
					    	else{
					    		$error[] = ['no' => $value->no];
					    		echo "2";
					    	}
					    	
						}
						else{
							echo "1";
							continue;
						}	
				}
				
			}
		}
		if(!empty($error)){
			$c=count($error);
			$request->session()->flash('alert-warning', 'Import Sarana Pinjaman Telah Berhasil Terupload , '.$c.' Data Gagal ditambahkan karena tidak memenuhi syarat');     	
		}
		else{
			$request->session()->flash('alert-success', 'Import Sarana Pinjaman Telah Berhasil Terupload');     
		}
		
       return redirect()->route("guru.sarana.pinjaman");
	}

	public function downloadExcelSaranaPengajuan($type)
	{
		$q = DB::table('pengajuans')->leftjoin('pengajuan_status','pengajuan_status.id','pengajuans.pengajuan_status_id')->select('pengajuans.nis','pengajuans.nip','pengajuans.nama_sarana','pengajuans.tgl','pengajuans.merek_sarana','pengajuans.tipe_sarana','pengajuans.total_sarana','pengajuan_status.status_pengajuan','pengajuans.keterangan')->get();//where('sarana_pinjams.sarana_pinjam_status_id','=','3')->
		
		$r=$q->toArray();
		$data = json_decode(json_encode($r), True);
		
		return Excel::create('Data Pengajuan Sarana', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
		
	}

	public function importExcelSaranaPengajuan(Request $request)
	{
		$sarana=Sarana::all();
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $value) {
						if (!empty($value['nama_sarana'])) {
							$siswa=DB::table('ak_siswa')->where('nis','=',$value['nis'])->select('nis')->get();
					    	if(!($siswa->isEmpty())){
					    		$insert = array (
								'nip' => Auth::user()->username,
					    		'nis' => $value['nis'],
								'nama_sarana' => $value['nama_sarana'],
								'tipe_sarana' => $value['tipe_sarana'],
								'merek_sarana' => $value['merek_sarana'],
								'total_sarana' => $value['total_sarana'],
								'pengajuan_status_id' => 1,
								'status' => 1,
								'keterangan' => $value['keterangan']	
								);	
								DB::table('pengajuans')->insert($insert);
					    	}
					    	else{
					    		$error[] = ['no' => $value->no];
					    	}
						}
						else{
							continue;
						}	
				}

				
			}
		}
		if(!empty($error)){
			$c=count($error);
			$request->session()->flash('alert-warning', 'Import Sarana Pinjaman Telah Berhasil Terupload , '.$c.' Data Gagal ditambahkan karena tidak memenuhi syarat');     	
		}
		else{
			$request->session()->flash('alert-success', 'Import Sarana Pinjaman Telah Berhasil Terupload');     
		}    
        return redirect()->route("guru.sarana.pengajuan");
	}

	public function downloadExcelPrasarana($type)
	{
		$q = DB::table('prasaranas')
		->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')
		->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')
		->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')
		->select(
			'prasaranas.kode_prasarana',
			'prasaranas.nama_prasarana',
			'prasaranas.tahun_peresmian',
			'ak_guru.nip',
			'ak_guru.namaguru',
			'prasarana_status.prasarana_status',
			'prasarana_kondisis.kondisi',
			'prasarana_status.prasarana_status',
			'prasarana_kondisis.kondisi',
			'prasaranas.keterangan'
			)
		->get();
		$r=$q->toArray();
		$data = json_decode(json_encode($r), True);
		return Excel::create('Data Prasarana', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

	public function importExcelPrasarana(Request $request)
	{
		$prasarana=Prasarana::all();
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $value) {
					$guru=DB::table('ak_guru')->where('nip','=',$value['pj_prasarana'])->select('nip')->get();
					$kondisi=DB::table('prasarana_kondisis')->where('id','=',$value['prasarana_kondisi_id'])->select('id')->get();
					$status=DB::table('prasarana_status')->where('id','=',$value['prasarana_status_id'])->select('id')->get();
						if ((!empty($value['kode_prasarana']))) {
							if ((!($guru->isEmpty()))&&(!($status->isEmpty()))&&(!($kondisi->isEmpty()))) {
								foreach ($prasarana as $s ) {
								if ($s['kode_prasarana']==$value['kode_prasarana']&&!empty($value['kode_prasarana'])) {
									Prasarana::where('kode_prasarana',$value['kode_prasarana'])
		    						->update(
		    							[
									'nip' => Auth::user()->username,
						    		'kode_prasarana' => $value['kode_prasarana'],
						    		'pj_prasarana' => $value['pj_prasarana'],
									'nama_prasarana' => $value['nama_prasarana'],
									'prasarana_status_id' => $value['prasarana_status_id'],
									'prasarana_kondisi_id' => $value['prasarana_kondisi_id'],
									'tahun_peresmian' => $value['tahun_peresmian'],
									'keterangan' => $value['keterangan']
										]
		    							);
								}
								else{
									$insert = array (
									'nip' => Auth::user()->username,
						    		'kode_prasarana' => $value['kode_prasarana'],
						    		'pj_prasarana' => $value['pj_prasarana'],
									'nama_prasarana' => $value['nama_prasarana'],
									'prasarana_status_id' => $value['prasarana_status_id'],
									'prasarana_kondisi_id' => $value['prasarana_kondisi_id'],
									'tahun_peresmian' => $value['tahun_peresmian'],
									'keterangan' => $value['keterangan']
									);
									Prasarana::insertIgnore($insert);
								}
							}
							}
							else{
								$error[] = ['no' => $value->no];
							}
						}
						else{
							continue;
						}
				}

				
				}
				
			}
		
		if(!empty($error)){
			$c=count($error);
			$request->session()->flash('alert-warning', 'Import Prasarana Telah Berhasil Terupload , '.$c.' Data Gagal ditambahkan karena tidak memenuhi syarat');     	
		}
		else{
		$request->session()->flash('alert-success', 'Import Prasarana Telah Berhasil Terupload');    
	}    
		
        return redirect()->route("guru.prasarana");
	}

	public function downloadExcelPrasaranaRuangan($type)
	{
		$q = DB::table('sarana_ruangans')->leftjoin('prasaranas','prasaranas.id','sarana_ruangans.prasarana_id')->leftjoin('prasarana_kondisis','prasarana_kondisis.id','prasaranas.prasarana_kondisi_id')->leftjoin('prasarana_status','prasarana_status.id','prasaranas.prasarana_status_id')->leftjoin('ak_guru','ak_guru.nip','prasaranas.pj_prasarana')->select('Sarana_ruangans.id','Sarana_ruangans.ruangan','prasaranas.nama_prasarana','prasaranas.pj_prasarana','prasaranas.kode_prasarana','prasarana_status.prasarana_status','prasarana_kondisis.kondisi','ak_guru.namaguru')->get();
		$r=$q->toArray();
		$data = json_decode(json_encode($r), True);
		return Excel::create('Data Ruangan', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

}

					
							
		