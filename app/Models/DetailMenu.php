<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailMenu extends Model
{
	use SoftDeletes;

	protected $table = 'T00_D_MENU';
	protected $primaryKey = ['FNO_H_MENU', 'FNO_PRODUK'];
	protected $keyType = 'string';

	protected $fillable = [
		'FNO_H_MENU', 'FNO_PRODUK'
	];
}
