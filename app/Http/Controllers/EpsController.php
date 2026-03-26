<?php

namespace App\Http\Controllers;


use App\Models\Eps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class EpsController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $eps = Eps::orderBy('nis')
            ->paginate(10);

        Log::info('Listado EPS cargado', [
            'total_registros' => $eps->total(),
        ]);

        return view('eps.index', compact('eps'));
    }

    /**
     * Crear
     */
    public function create()
    {
        Log::info('Formulario create EPS abierto');

        return view('eps.create');
    }

    /**
     * Guardar
     */
    public function store(Request $request)
    {
        Log::info('Datos recibidos STORE EPS', $request->all());

        $data = $request->validate([
            'numdoc' => 'required|integer|unique:tbl_eps,numdoc',
            'denominacion' => 'required|string|max:255',
            'observaciones' => 'required|string',
        ]);

        Log::info('Datos validados STORE EPS', $data);

        $nuevo = Eps::create($data);

        Log::info('EPS creada correctamente', [
            'nis' => $nuevo->nis,
            'numdoc' => $nuevo->numdoc,
            'denominacion' => $nuevo->denominacion,
        ]);

        Alert::success('¡Creado!', 'La EPS se ha registrado correctamente.');

        return redirect()->route('eps.index');
    }

    /**
     * Mostrar detalle
     */
    public function show(Eps $ep)
    {
        Log::info('DEBUG COMPLETO - EPS', [
            'nis' => $ep->nis,
            'numdoc' => $ep->numdoc,
            'denominacion' => $ep->denominacion,
            'observaciones' => $ep->observaciones,
            'created_at' => $ep->created_at,
            'updated_at' => $ep->updated_at,
        ]);

        return view('eps.show', compact('ep'));
    }

    /**
     * Editar
     */
    public function edit(Eps $ep)
    {
        Log::info('Editando EPS', [
            'nis' => $ep->nis,
        ]);

        return view('eps.edit', compact('ep'));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, Eps $ep)
    {
        Log::info('Datos recibidos UPDATE EPS', $request->all());

        $data = $request->validate([
            'numdoc' => 'required|integer|unique:tbl_eps,numdoc,'.$ep->nis.',nis',
            'denominacion' => 'required|string|max:255',
            'observaciones' => 'required|string',
        ]);

        $ep->update($data);

        Log::info('EPS actualizada', [
            'nis' => $ep->nis,
        ]);

        Alert::info('¡Actualizado!', 'La EPS se ha modificado correctamente.');

        return redirect()->route('eps.index');
    }

    /**
     * Eliminar
     */
    public function destroy(Eps $ep)
    {
        // Verificar relaciones antes de eliminar
        $tieneAprendices = $ep->aprendices()->count();
        $tieneInstructores = $ep->instructores()->count();

        if ($tieneAprendices > 0 || $tieneInstructores > 0) {
            Log::warning('Intento de eliminar EPS con relaciones', [
                'nis' => $ep->nis,  // Cambiado de $eps a $ep
                'aprendices_relacionados' => $tieneAprendices,
                'instructores_relacionados' => $tieneInstructores,
            ]);

            Alert::error('¡Error!', 'No se puede eliminar la EPS porque tiene aprendices o instructores asociados.');

            return redirect()->route('eps.index');
        }

        Log::warning('EPS eliminada', [
            'nis' => $ep->nis,
            'numdoc' => $ep->numdoc,
            'denominacion' => $ep->denominacion,
        ]);

        $ep->delete();

        Alert::warning('¡Eliminado!', 'La EPS se ha eliminado correctamente.');

        return redirect()->route('eps.index');
    }
}
