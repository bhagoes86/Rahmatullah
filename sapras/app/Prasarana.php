<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Prasarana extends Model
{
    protected $fillable = ['id','nip', 'nama_prasarana', 'status_prasarana' , 'pj_prasarana','tahun_peresmian','keterangan','kondisi_prasarana']; 
   public $timestamps = false;
   public static function insertIgnore($array){
    $a = new static();
    if($a->timestamps){
        $now = \Carbon\Carbon::now();
        $array['created_at'] = $now;
        $array['updated_at'] = $now;
    }
    DB::insert('INSERT IGNORE INTO prasaranas ('.implode(',',array_keys($array)).
        ') values (?'.str_repeat(',?',count($array) - 1).')',array_values($array));
    }
}
