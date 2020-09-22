<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
	protected $table = 't00_m_topping';
	protected $primaryKey = 'FK_TOPPING';
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'FK_TOPPING', 'FN_TOPPING', 'FK_MENU', 'FHARGA'
	];
}
