<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
	protected $table = 'T20_D_BAYAR';
	protected $primaryKey = 'FNO_D_BAYAR';
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'FNO_D_BAYAR', 'FNO_H_BAYAR', 'FNO_D_PESAN', 'FJML', 'FHARGA'
	];

	public function pesanan()
	{
		return $this->hasOne('App\Models\PesananDetail', 'FNO_D_PESAN', 'FNO_D_PESAN');
	}

	public function header()
	{
		return $this->belongsTo('App\Models\PembayaranHeader', 'FNO_H_BAYAR', 'FNO_H_BAYAR');
	}
	
}
