<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';

    protected $fillable = [
        'nombre_original',
        'nombre_guardado',
        'ruta',
        'tipo_mime',
        'tamano',
        'descripcion',
        'tbl_aprendices_NIS'
    ];

    public function aprendiz()
    {
        return $this->belongsTo(
            Aprendice::class,
            'tbl_aprendices_NIS',
            'NIS'
        );
    }

    public function getTamanoFormateadoAttribute()
    {
        return number_format($this->tamano / 1024, 2) . ' KB';
    }
}
