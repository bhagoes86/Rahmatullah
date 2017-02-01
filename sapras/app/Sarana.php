<?php

namespace App;
Use DB;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    protected $fillable = ['id','nip', 'kode_sarana', 'nama_sarana' , 'no_regis','merk_sarana', 'total_harga','bahan','tahun_pembelian','asal_sarana','harga_sarana','total_sarana','status_sarana','kondisi_sarana','ruangan','keterangan'];
	public $timestamps = false;

    /*
    public function sarana_pinjams(){
    	return $this->hasMany(Sarana_pinjam::class);
    }

    public function path(){
    	return '/sarana/' . $this->id;
    }
    */

    public function sarana_pinjams(){
        return $this->hasMany(Sarana_pinjam::class);
    }

    public function sarana_pengajuans(){
        return $this->hasMany(Sarana_pengajuan::class);
    
    }

    public static function insertIgnore($array){
    $a = new static();
    if($a->timestamps){
        $now = \Carbon\Carbon::now();
        $array['created_at'] = $now;
        $array['updated_at'] = $now;
    }
    DB::insert('INSERT IGNORE INTO saranas ('.implode(',',array_keys($array)).
        ') values (?'.str_repeat(',?',count($array) - 1).')',array_values($array));
    }
}
