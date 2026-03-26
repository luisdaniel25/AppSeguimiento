<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Entecoformadore extends Model
{
    protected $table = 'tbl_entecoformadores';
    protected $primaryKey = 'NIS';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'NIS' => 'int',
        'NumDoc' => 'int',
        'tbl_tiposdocumentos_nis' => 'int',
        'tbl_rolesadministrativos_NIS' => 'int'
    ];

    protected $fillable = [
        'NumDoc',
        'RazonSocial',
        'Direccion',
        'Telefono',
        'CorreoInstitucional',
        'tbl_tiposdocumentos_nis',
        'tbl_rolesadministrativos_NIS'
    ];

    public function rolesadministrativo()
    {
        return $this->belongsTo(Rolesadministrativo::class, 'tbl_rolesadministrativos_NIS');
    }

    public function tiposdocumento()
    {
        return $this->belongsTo(Tiposdocumento::class, 'tbl_tiposdocumentos_nis');
    }
}
