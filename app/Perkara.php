<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perkara extends Model
{
	protected $table = 'perkara';
	protected $fillable = ['no_perkara', 'jenis_perkara_id'];


	public function jenis_perkara()
	{
		return $this->belongsTo('App\JenisPerkara');
	}

	public function berkas_perkara()
	{
		return $this->hasMany('App\BerkasPerkara');
	}
}
