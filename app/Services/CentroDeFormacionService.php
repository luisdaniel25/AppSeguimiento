<?php

namespace App\Services;

use App\Models\Centrodeformacion;
use App\Models\Regionale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CentroDeFormacionService
{
    /**
     * Retorna todos los centros con su regional asociada, paginados.
     */
    public function listar(int $porPagina = 15): LengthAwarePaginator
    {
        return Centrodeformacion::with('regionale')
            ->paginate($porPagina);
    }
    /**
     * Retorna los datos necesarios para poblar formularios.
     */
    public function datosDelFormulario(): array
    {
        return [
            'regionales' => Regionale::orderBy('Denominacion')->get(),
        ];
    }
    /**
     * Crea un nuevo centro de formación.
     */
    public function crear(array $datos): Centrodeformacion
    {
        return Centrodeformacion::create($datos);
    }
    /**
     * Retorna el centro con sus relaciones cargadas para la vista de detalle.
     */
    public function verDetalles(Centrodeformacion $centro): Centrodeformacion
    {
        return $centro->load('regionale', 'aprendices');
    }
    /**
     * Actualiza los datos de un centro existente.
     */
    public function actualizar(Centrodeformacion $centro, array $datos): bool
    {
        return $centro->update($datos);
    }
    /**
     * Elimina un centro de formación.
     */
    public function eliminar(Centrodeformacion $centro): bool
    {
        return $centro->delete();
    }
}
