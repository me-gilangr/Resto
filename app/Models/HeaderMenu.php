<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeaderMenu extends Model
{
	use SoftDeletes;

	protected $table = 'T00_H_MENU';
	protected $primaryKey = 'FNO_H_MENU';
	protected $keyType = 'string';

	protected $fillable = [
		'FNO_H_MENU', 'FN_MENU', 'FHARGAPOKOK', 'FMARGIN', 'FPAJAK', 'FHARGAJUAL', 'FSTATUS', 'FGAMBAR'
	];

	protected $attributes = [
		'FSTATUS' => 1,
	];

	public function detail()
	{
		return $this->hasMany('App\Models\DetailMenu', 'FNO_H_MENU', 'FNO_H_MENU');

	}
}
