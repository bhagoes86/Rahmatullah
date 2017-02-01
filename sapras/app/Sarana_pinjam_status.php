<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sarana_pinjam_status extends Model
{
	protected $table = 'Sarana_pinjam_status';
    public function sarana(){
    	return $this->belongsTo(Sarana_pinjam::class);
    }
}
