<?php

namespace App\Http\Controllers;

use App\Models\Fichadecaracterizacion;
use App\Models\Programasdeformacion;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramasdeformacionController extends Controller
{
    /**
     * Listado
     */
    public function index()
    {
        $programas = Programasdeformacion::with([
            'fichasCaracterizacion',
            'aprendices',
        ])
            ->orderBy('NIS')
            ->paginate(10);

        return view('programas.index', compact('programas'));
    }

    /**
     * Formulario creación
     */
    public function create()
    {
        $fichas = Fichadecaracterizacion::all();

        return view('programas.create', compact('fichas'));
    }

    /**
     * Guardar registro
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_programasdeformacion,Codigo',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:500',
        ]);

        Programasdeformacion::create($validated);

        Alert::success('Muy Bien', 'Programa de formación creado exitosamente.');

        return redirect()->route('programas.index');
    }

    /**
     * Mostrar detalle
     */
    public function show(Programasdeformacion $programa)
    {
        $programa->load([
            'fichasCaracterizacion',
            'aprendices',
        ]);

        return view('programas.show', compact('programa'));
    }

    /**
     * Formulario edición
     */
    public function edit(Programasdeformacion $programa)
    {
        $fichas = Fichadecaracterizacion::all();

        return view('programas.edit', compact('programa', 'fichas'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, Programasdeformacion $programa)
    {
        $validated = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_programasdeformacion,Codigo,'.$programa->NIS.',NIS',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:500',
        ]);

        $programa->update($validated);

        Alert::success('Muy Bien', 'Programa de formación actualizado exitosamente.');

        return redirect()->route('programas.index');
    }

    /**
     * Eliminar registro
     */
    public function destroy(Programasdeformacion $programa)
    {
        // Verificar si tiene aprendices asociados
        if ($programa->aprendices()->count() > 0) {
            Alert::warning('No se puede eliminar', 'Este programa tiene aprendices asociados. Reasígnalos antes de eliminar.');

            return redirect()->route('programas.index');
        }

        // Verificar si tiene fichas asociadas
        if ($programa->fichasCaracterizacion()->count() > 0) {
            Alert::warning('No se puede eliminar', 'Este programa tiene fichas asociadas.');

            return redirect()->route('programas.index');
        }

        $programa->delete();

        Alert::success('Muy Bien', 'Programa de formación eliminado exitosamente.');

        return redirect()->route('programas.index');
    }
}
