<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesananHeader extends Model
{
	use SoftDeletes;

	protected $table = 'T10_H_PESANAN';
	protected $primaryKey = 'FNO_PESAN';
	protected $keyType = 'string';

	protected $fillable = [
		'FNO_PESAN', 'TGL_PESAN', 'FATAS_NAMA', 'FSTATUS_TRANSAKSI'
	];

	public function detail()
	{
		return $this->hasMany('App\Models\PesananDetail', 'FNO_PESAN', 'FNO_PESAN');
	}

	public function meja()
	{
		return $this->hasMany('App\Models\PesananMeja', 'FNO_PESAN', 'FNO_PESAN');
	}

	public function pemasakan()
	{
		return $this->hasMany('App\Models\PemasakanHeader', 'FNO_PESAN', 'FNO_PESAN');
	}
}
