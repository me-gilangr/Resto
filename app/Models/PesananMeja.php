<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesananMeja extends Model
{
	use SoftDeletes;

	protected $table = 'T10_D_PESAN_MEJA';
	protected $primaryKey = ['FNO_PESAN', 'FNO_MEJA'];
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'FNO_PESAN', 'FNO_MEJA'
	];

	public function header()
	{
		return $this->belongsTo('App\Models\PesananMeja', 'FNO_PESAN', 'FNO_PESAN');
	}
}
