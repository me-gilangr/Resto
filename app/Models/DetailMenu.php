<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailMenu extends Model
{
	protected $table = 'T00_D_MENU';
	protected $primaryKey = ['FNO_H_MENU', 'FNO_PRODUK'];
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'FNO_H_MENU', 'FNO_PRODUK'
	];

	public function header()
	{
		return $this->belongsTo('App\Models\HeaderMenu', 'FNO_H_MENU', 'FNO_H_MENU');
	}

	public function product()
	{
		return $this->hasOne('App\Models\Product', 'FNO_PRODUK', 'FNO_PRODUK');
	}
}
