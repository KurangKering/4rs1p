<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPerkara extends Model
{
	protected $table = 'jenis_perkara';
	protected $fillable = ['nama'];

	public function perkara()
	{
		return $this->hasMany('App\Perkara');
	}
}
