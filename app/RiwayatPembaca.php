<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPembaca extends Model
{
	protected $table = 'riwayat_pembaca';
	protected $fillable = ['nama_pembaca', 'user_id', 'berkas_perkara_id', 'tanggal'];


	public function berkas_perkara()
	{
		return $this->belongsTo('App\BerkasPerkara');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
