<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class Regionale extends Model
{
	protected $table = 'tbl_regionales';
	protected $primaryKey = 'NIS';

	protected $casts = [
		'Codigo' => 'int'
	];

	protected $fillable = [
		'Codigo',
		'Denominacion',
		'Observaciones'
	];

	public function centrodeformacions()
	{
		return $this->hasMany(Centrodeformacion::class, 'tbl_regionales_NIS');
	}
}
