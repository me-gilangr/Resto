<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $table = 'T00_REF_MENU';
	protected $primaryKey = 'FNO_KATEGORI';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FNO_KATEGORI', 'FN_KATEGORI'
	];
}

