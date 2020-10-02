<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
	use SoftDeletes;

  protected $table = 't00_m_produk';
	protected $primaryKey = 'FNO_PRODUK';
	protected $keyType = 'string';

	protected $fillable = [
		'FNO_PRODUK', 'FNO_KATEGORI', 'FN_NAMA'
	];

	public function kategori()
	{
		return $this->hasOne('App\Models\Kategori', 'FNO_KATEGORI', 'FNO_KATEGORI');
	}
}
