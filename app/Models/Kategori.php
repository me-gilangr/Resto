<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $table = 't00_ref_produk';
	protected $primaryKey = 'FNO_KATEGORI';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FNO_KATEGORI', 'FN_KATEGORI'
	];
}

