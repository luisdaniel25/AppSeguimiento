<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructore extends Model
{
    protected $table = 'tbl_instructores';
    protected $primaryKey = 'NIS';
    public $timestamps = true;

    protected $casts = [
        'NumDoc' => 'int',
        'Sexo' => 'int',
        'FechaNac' => 'date',
        'tbl_tiposdocumentos_nis' => 'int',
        'tbl_eps_nis' => 'int',
    ];

    protected $fillable = [
        'NumDoc',
        'Nombres',
        'Apellidos',
        'Direccion',
        'Telefono',
        'CorreoInstitucional',
        'CorreoPersonal',
        'Sexo',
        'FechaNac',
        'tbl_tiposdocumentos_nis',
        'tbl_eps_nis',
    ];

    // Relaciones
    public function eps()
    {
        return $this->belongsTo(Eps::class, 'tbl_eps_nis');
    }

    public function tiposdocumento()
    {
        return $this->belongsTo(Tiposdocumento::class, 'tbl_tiposdocumentos_nis');
    }

    public function fichadecaracterizacion()
    {
        return $this->hasMany(Fichadecaracterizacion::class, 'tbl_instructores_NIS', 'NIS');
    }
}
