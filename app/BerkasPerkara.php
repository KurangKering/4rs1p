<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BerkasPerkara extends Model
{
    protected $table = 'berkas_perkara';
    protected $fillable = ['perkara_id', 'nama', 'file'];

    public function perkara()
	{
		return $this->belongsTo('App\Perkara');
	}

	public function riwayat_pembaca()
	{
		return $this->hasMany('App\RiwayatPembaca');
	}
}
