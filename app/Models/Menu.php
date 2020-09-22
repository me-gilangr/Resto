<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'T00_M_MENU';
	protected $primaryKey = 'FNO_MENU';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FNO_MENU', 'FNO_KATEGORI', 'FN_NAMA', 'FHARGA', 'DISC', 'FGAMBAR', 'STATUS_MENU'
	];
}
