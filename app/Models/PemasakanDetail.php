<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemasakanDetail extends Model
{
	use SoftDeletes;

	protected $table = 'T10_D_PEMASAKAN';
	// protected $primaryKey = ['FNO_H_PEMASAKAN', 'FNO_PRODUK'];
	protected $primaryKey = 'FNO_D_PEMASAKAN';
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'FNO_D_PEMASAKAN', 'FNO_H_PEMASAKAN', 'FNO_PRODUK', 'USER_ID', 'FJML', 'FSTATUS', 'FTEMPAT'
	];

	public function header()
	{
		return $this->belongsTo('App\Models\PemasakanHeader', 'FNO_H_PEMASAKAN', 'FNO_H_PEMASAKAN');
	}

	public function produk()
	{
		return $this->hasOne('App\Models\Produk', 'FNO_PRODUK', 'FNO_PRODUK');
	}
}
