<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

  /*
  Modelo Eloquent encargado de interactuar con la tabla `tbl_aprendices`
  dentro de la base de datos. Representa la información de los aprendices
 registrados en el sistema y sus relaciones con otras entidades como
  programas de formación, centros de formación, tipos de documento y EPS.
  */
class Aprendice extends Model
{


    // Nombre de la tabla asociada al modelo.

    protected $table = 'tbl_aprendices';


    //  Clave primaria de la tabla.

    protected $primaryKey = 'NIS';


    // Indica si el modelo maneja timestamps (created_at y updated_at).

    public $timestamps = true;


    // Conversión automática de tipos de datos.

    protected $casts = [
        'NumDoc' => 'int',
        'Sexo' => 'int',
        'FechaNac' => 'date',
        'tbl_tiposdocumentos_nis' => 'int',
        'tbl_programasdeformacion_NIS' => 'int',
        'tbl_centrodeformacion_NIS' => 'int',
        'tbl_eps_nis' => 'int',
    ];

    //Campos que pueden ser asignados masivamente.

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
        'tbl_programasdeformacion_NIS',
        'tbl_centrodeformacion_NIS',
        'tbl_eps_nis',
    ];

    /*
     Relación con el modelo Centrodeformacion.
     Un aprendiz pertenece a un centro de formación.
     */
    public function centrodeformacion()
    {
        return $this->belongsTo(Centrodeformacion::class, 'tbl_centrodeformacion_NIS', 'NIS');
    }

    /*
     Relación con el modelo EPS.
     Un aprendiz pertenece a una EPS.
     */
    public function eps()
    {
        return $this->belongsTo(Eps::class, 'tbl_eps_nis', 'nis');
    }

    /*
     Relación con el modelo Programasdeformacion.
     Un aprendiz pertenece a un programa de formación
     */
    public function programasdeformacion()
    {
        return $this->belongsTo(Programasdeformacion::class, 'tbl_programasdeformacion_NIS', 'NIS');
    }

     /*
     Relación con el modelo tiposdocumento
     Define el tipo de documento del aprendiz.
     */
    public function tiposdocumento()
    {
        return $this->belongsTo(Tiposdocumento::class, 'tbl_tiposdocumentos_nis', 'nis');
    }

    /*
     Obtiene el instructor asociado al aprendiz a través
     de la relación con el programa de formación y la ficha
     de caracterización si alguna relación intermedia no existe.
     */
    public function getInstructorAttribute()
    {
        return $this->programasdeformacion?->fichadecaracterizacion?->instructor;
    }
}
