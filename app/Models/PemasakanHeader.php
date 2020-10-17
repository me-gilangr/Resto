<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemasakanHeader extends Model
{
	use SoftDeletes;

	protected $table = 'T10_H_PEMASAKAN';
	protected $primaryKey = ['FNO_H_PEMASAKAN', 'FNO_D_PESAN'];
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'FNO_H_PEMASAKAN', 'FNO_D_PESAN',
	];

	public function detail()
	{
		return $this->hasMany('App\Models\PemasakanDetail', 'FNO_H_PEMASAKAN', 'FNO_H_PEMASAKAN');
	}

	public function pesananDetail()
	{
		return $this->hasOne('App\Models\PesananDetail', 'FNO_D_PESAN', 'FNO_D_PESAN');
	}
}

