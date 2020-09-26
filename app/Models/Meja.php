<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
	protected $table = 't00_m_meja';
	protected $primaryKey = 'FNO_MEJA';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FNO_MEJA', 'FJENIS', 'STATUS'
	];
}
