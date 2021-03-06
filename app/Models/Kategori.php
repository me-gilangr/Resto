<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use SoftDeletes;

	protected $table = 't00_ref_produk';
	protected $primaryKey = 'FNO_KATEGORI';
	protected $keyType = 'string';

	protected $fillable = [
		'FNO_KATEGORI', 'FK_GROUP', 'FN_KATEGORI'
	];

	public function produk()
	{
		return $this->belongsTo('App\Models\Produk', 'FNO_KATEGORI', 'FNO_KATEGORI');
	}

	public function group()
	{
		return $this->hasOne('App\Models\KodeGroup', 'FK_GROUP', 'FK_GROUP');
	}
}

