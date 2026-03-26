<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class Tiposdocumento extends Model
{
	protected $table = 'tbl_tiposdocumentos';
	protected $primaryKey = 'nis';

	protected $fillable = [
		'denominacion',
		'observaciones'
	];

	public function aprendices()
	{
		return $this->hasMany(Aprendice::class, 'tbl_tiposdocumentos_nis');
	}

	public function entecoformadores()
	{
		return $this->hasMany(Entecoformadore::class, 'tbl_tiposdocumentos_nis');
	}

	public function instructores()
	{
		return $this->hasMany(Instructore::class, 'tbl_tiposdocumentos_nis');
	}
}
