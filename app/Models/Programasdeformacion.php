<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programasdeformacion extends Model
{
    protected $table = 'tbl_programasdeformacion';
    protected $primaryKey = 'NIS';
    public $timestamps = true;
    public $incrementing = true;

    protected $casts = [
        'Codigo' => 'int',
    ];

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Observaciones',
    ];


    public function fichasCaracterizacion()
    {
        return $this->hasMany(Fichadecaracterizacion::class, 'tbl_programasdeformacion_NIS', 'NIS');
    }

    // Relación con aprendices
    public function aprendices()
    {
        return $this->hasMany(Aprendice::class, 'tbl_programasdeformacion_NIS', 'NIS');
    }
}
