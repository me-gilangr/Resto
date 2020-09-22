<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $table = 't00_m_kat';
	protected $primaryKey = 'FK_KAT';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FK_KAT', 'FN_KAT'
	];
}

