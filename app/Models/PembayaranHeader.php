<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranHeader extends Model
{
	protected $table = 'T20_H_BAYAR';
	protected $primaryKey = 'FNO_H_BAYAR';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'FNO_H_BAYAR', 'FTGL_BAYAR', 'USER_ID', 'FTOTAL'
	];

	public function user()
	{
		return $this->belongsTo('App\User', 'USER_ID', 'id');
	}
}
