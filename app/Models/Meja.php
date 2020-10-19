<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meja extends Model
{
	protected $table = 't00_m_meja';
	protected $primaryKey = 'FNO_MEJA';
	protected $keyType = 'string';

	protected $fillable = [
		'FNO_MEJA', 'FJENIS', 'STATUS'
	];

	protected $attributes = [
		'STATUS' => false,
	];

	use SoftDeletes;

	public function pesanan()
	{
		return $this->belongsTo('App\Models\PesananMeja', 'FNO_MEJA', 'FNO_MEJA')
			->orderByRaw("ISNULL(created_at), created_at DESC");
	}
}
