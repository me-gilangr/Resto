<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPembuatan extends Model
{
	protected $table = 't00_ref_group';
	protected $primaryKey = ['FNO_PRODUK', 'FTEMPAT'];
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'FNO_PRODUK', 'FTEMPAT'
	];
	
	public function produk()
	{
		return $this->hasOne('App\Models\Produk', 'FNO_PRODUK', 'FNO_PRODUK');
	}
}
