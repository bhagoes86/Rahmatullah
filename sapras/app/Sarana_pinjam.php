<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sarana_pinjam extends Model
{
     protected $fillable = ['id','nis','nama_sarana','jumlah_pinjam','waktu_pengembalian','status','status_pinjam','keterangan'];

	public $timestamps = false;
}
