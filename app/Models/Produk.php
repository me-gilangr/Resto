<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $table = 't00_m_produk';
	protected $primaryKey = 'FNO_PRODUK';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FNO_PRODUK', 'FNO_KATEGORI', 'FN_NAMA', 'FHARGA', 'DISC', 'FGAMBAR', 'STATUS_MENU'
	];
}
