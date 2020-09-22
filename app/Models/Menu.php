<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 't00_m_menu';
	protected $primaryKey = 'FK_MENU';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FK_MENU', 'FN_MENU', 'FK_KAT', 'FDESKRIPSI', 'FHARGA'
	];
}
