<?php

namespace App\Services;

use App\Models\Aprendice;
use App\Models\Centrodeformacion;
use App\Models\Eps;
use App\Models\Programasdeformacion;
use App\Models\Tiposdocumento;

class AprendiceService
{
    /**
     * Retorna los aprendices paginados con sus relaciones.
     */
    public function listar(int $porPagina = 10)
    {
        return Aprendice::with([
            'centrodeformacion',
            'eps',
            'programasdeformacion',
            'tiposdocumento',
        ])
            ->orderBy('NIS')
            ->paginate($porPagina);
    }

    /**
     * Retorna los datos necesarios para los selects del formulario.
     */
    public function editar(): array
    {
        return [
            'centros' => Centrodeformacion::all(),
            'listaEps' => Eps::all(),
            'programas' => Programasdeformacion::all(),
            'tiposdoc' => Tiposdocumento::all()
        ];
    }

    /**
     * Carga las relaciones de un aprendiz.
     */
    public function ver_detalles(Aprendice $aprendice): Aprendice
    {
        return $aprendice->load([
            'centrodeformacion',
            'eps',
            'programasdeformacion',
            'tiposdocumento',
        ]);
    }

    /**
     * Crea un nuevo aprendiz.
     */
    public function crear(array $datos): Aprendice
    {
        return Aprendice::create($datos);
    }

    /**
     * Actualiza un aprendiz existente.
     */
    public function actualizar(Aprendice $aprendice, array $datos): Aprendice
    {
        $aprendice->update($datos);

        return $aprendice->fresh();
    }

    /**
     * Elimina un aprendiz.
     */
    public function eliminar(Aprendice $aprendice): void
    {
        $aprendice->delete();
    }
}
