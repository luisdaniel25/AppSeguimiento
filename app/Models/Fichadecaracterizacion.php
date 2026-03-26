<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichadecaracterizacion extends Model
{
    protected $table = 'tbl_fichadecaracterizacion';
    protected $primaryKey = 'NIS';
    public $timestamps = true;



    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Cupo',
        'FechaInicio',
        'FechaFin',
        'Observaciones',
        'tbl_instructores_NIS',
        'tbl_programasdeformacion_NIS',

    ];
    protected $casts = [
        'FechaInicio' => 'date',
        'FechaFin' => 'date',
        'tbl_instructores_NIS' => 'integer',
    ];



    // 🔹 Relación con Instructor
    public function instructor()
    {
        return $this->belongsTo(
            Instructore::class,
            'tbl_instructores_NIS',
            'NIS'
        );
    }

    // 🔹 Relación con programas de Formación
    public function programaDeFormacion()
    {
        return $this->belongsTo(
            Programasdeformacion::class,
            'tbl_programasdeformacion_NIS',
            'NIS'
        );
    }
}
