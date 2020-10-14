<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemasakanHeader extends Model
{
	use SoftDeletes;

	protected $table = 'T10_H_PEMASAKAN';
	protected $primaryKey = 'FNO_PEMASAKAN';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'FNO_H_PEMASAKAN', 'FNO_PESAN', 'FNO_H_MENU', 'USER_ID'
	];

	public function detail()
	{
		return $this->hasMany('App\Models\PemasakanDetail', 'FNO_H_PEMASAKAN', 'FNO_H_PEMASAKAN');
	}

	public function pesananHeader()
	{
		return $this->hasOne('App\Models\PesananHeader', 'FNO_PESAN', 'FNO_PESAN');
	}

	public function menuHeader()
	{
		return $this->belongsTo('App\Models\HeaderMenu', 'FNO_H_MENU', 'FNO_H_MENU');
	}
}

