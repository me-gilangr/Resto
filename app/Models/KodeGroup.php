<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KodeGroup extends Model
{
	use SoftDeletes;

	protected $table = 't00_ref_kategori';
	protected $primaryKey = 'FK_GROUP';
	protected $keyType = 'string';

	protected $fillable = [
		'FK_GROUP', 'FN_GROUP'
	];
}
