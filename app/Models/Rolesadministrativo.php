<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;



class Rolesadministrativo extends Model
{
	protected $table = 'tbl_rolesadministrativos';
	protected $primaryKey = 'NIS';

	protected $fillable = [
		'Descripcion'
	];

	public function entecoformadores()
	{
		return $this->hasMany(Entecoformadore::class, 'tbl_rolesadministrativos_NIS');
	}
}
