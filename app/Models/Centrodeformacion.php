<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centrodeformacion extends Model
{
    protected $table = 'tbl_centrodeformacion';

    protected $primaryKey = 'NIS';

    public $incrementing = true;


    protected $keyType = 'int';

    public $timestamps = true;

    protected $casts = [
        'Codigo' => 'integer',
        'tbl_regionales_NIS' => 'integer'
    ];

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Direccion',
        'Observaciones',
        'tbl_regionales_NIS'
    ];
    // Centro pertenece a una regional
    public function regionale()
    {
        return $this->belongsTo(
            Regionale::class,
            'tbl_regionales_NIS',
            'NIS'
        );
    }

    // Centro tiene muchos aprendices
    public function aprendices()
    {
        return $this->hasMany(
            Aprendice::class,
            'tbl_centrodeformacion_NIS',
            'NIS'
        );
    }
}
