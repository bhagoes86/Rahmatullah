<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
	protected $fillable = ['id','nis','nama_sarana','tipe_sarana','merek_sarana','total_sarana','keterangan'];
    public $timestamps = false;
}
