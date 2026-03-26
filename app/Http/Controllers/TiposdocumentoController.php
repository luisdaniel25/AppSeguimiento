<?php

namespace App\Http\Controllers;


use App\Models\Tiposdocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class TiposdocumentoController extends Controller
{
    /**
     * Listar todos los tipos de documento
     */
    public function index()
    {
        $tipos = Tiposdocumento::orderBy('nis')->paginate(10);
        return view('Tiposdocumento.index', compact('tipos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('Tiposdocumento.create');
    }

    /**
     * Guardar nuevo tipo de documento
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'denominacion' => 'required|string|max:255|unique:tbl_tiposdocumentos,denominacion',
            'observaciones' => 'nullable|string',
        ]);

        try {
            $tipo = Tiposdocumento::create($data);
            Alert::success('¡Creado!', 'El tipo de documento se ha registrado correctamente.');
            Log::info("Tipo de documento creado: NIS {$tipo->nis}, Denominación: {$tipo->denominacion}");
        } catch (\Exception $e) {
            Alert::error('Error', 'No se pudo crear el tipo de documento.');
            Log::error("Error creando tipo de documento: " . $e->getMessage());
        }

        return redirect()->route('tiposdocumento.index');
    }

    /**
     * Mostrar detalle de un tipo de documento
     */
    public function show(Tiposdocumento $tiposdocumento)
    {
        return view('Tiposdocumento.show', compact('tiposdocumento'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Tiposdocumento $tiposdocumento)
    {
        return view('Tiposdocumento.edit', compact('tiposdocumento'));
    }

    /**
     * Actualizar tipo de documento
     */
    public function update(Request $request, Tiposdocumento $tiposdocumento)
    {
        $data = $request->validate([
            'denominacion' => 'required|string|max:255|unique:tbl_tiposdocumentos,denominacion,' . $tiposdocumento->nis . ',nis',
            'observaciones' => 'nullable|string',
        ]);

        try {
            $tiposdocumento->update($data);
            Alert::info('¡Actualizado!', 'El tipo de documento se ha modificado correctamente.');
            Log::info("Tipo de documento actualizado: NIS {$tiposdocumento->nis}, Denominación: {$tiposdocumento->denominacion}");
        } catch (\Exception $e) {
            Alert::error('Error', 'No se pudo actualizar el tipo de documento.');
            Log::error("Error actualizando tipo de documento NIS {$tiposdocumento->nis}: " . $e->getMessage());
        }

        return redirect()->route('tiposdocumento.index');
    }

    /**
     * Eliminar tipo de documento
     */
    public function destroy(Tiposdocumento $tiposdocumento)
    {
        try {
            $nis = $tiposdocumento->nis;
            $denom = $tiposdocumento->denominacion;
            $tiposdocumento->delete();
            Alert::warning('¡Eliminado!', 'El tipo de documento se ha eliminado correctamente.');
            Log::warning("Tipo de documento eliminado: NIS {$nis}, Denominación: {$denom}");
        } catch (\Exception $e) {
            Alert::error('Error', 'No se pudo eliminar el tipo de documento.');
            Log::error("Error eliminando tipo de documento NIS {$tiposdocumento->nis}: " . $e->getMessage());
        }

        return redirect()->route('tiposdocumento.index');
    }
}
