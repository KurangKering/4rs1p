<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPembaca extends Model
{
	protected $table = 'riwayat_pembaca';
	protected $fillable = ['nama_pembaca', 'no_perkara', 'nama_berkas', 'tanggal'];


	public function berkas_perkara()
	{
		return $this->belongsTo('App\BerkasPerkara');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
