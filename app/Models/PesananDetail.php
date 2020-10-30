<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesananDetail extends Model
{
	use SoftDeletes;

	protected $table = 'T10_D_PESANAN';
	protected $primaryKey = 'FNO_D_PESAN';
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'FNO_D_PESAN', 
		'FNO_H_PESAN', 
		'FNO_H_MENU', 
		'FJML', 
		'FHARGA', 
		'FDISC', 
		'FKET', 
		'FSTATUS_PESAN',
	];

	protected $attributes = [
		'FDISC' => 0,
	];

	public function menuHeader()
	{
		return $this->hasOne('App\Models\HeaderMenu', 'FNO_H_MENU', 'FNO_H_MENU');
	}

	public function menuDetail()
	{
		return $this->hasMany('App\Models\DetailMenu', 'FNO_H_MENU', 'FNO_H_MENU');
	}

	public function header()
	{
		return $this->belongsTo('App\Models\PesananHeader', 'FNO_H_PESAN', 'FNO_H_PESAN');
	}
	
	public function bayar()
	{
		return $this->hasMany('App\Models\PembayaranDetail', 'FNO_D_PESAN', 'FNO_D_PESAN');
	}
}
