<?php

namespace App\Http\Controllers;


use App\Models\Centrodeformacion;
use App\Models\Regionale;
use Illuminate\Http\Request;

class CentrodeformacionController extends Controller
{
    /**
     * LISTADO
     */
    public function index()
    {
        $centros = Centrodeformacion::with('regionale')
            ->orderBy('NIS')
            ->paginate(10);

        return view('Centros.index', compact('centros'));
    }

    /**
     * FORM CREAR
     */
    public function create()
    {
        $regionales = Regionale::all();

        return view('Centros.create', compact('regionales'));
    }

    /**
     * GUARDAR
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Observaciones' => 'nullable|string|max:200',
            'tbl_regionales_NIS' => 'required|integer|exists:tbl_regionales,NIS',
        ]);

        Centrodeformacion::create($data);

        return redirect()
            ->route('centros.index')
            ->with('success', 'Centro creado correctamente');
    }

    /**
     * VER DETALLE
     */
    public function show(Centrodeformacion $centro)
    {
        $centro->load('regionale');

        return view('Centros.show', compact('centro'));
    }

    /**
     * FORM EDITAR
     */
    public function edit(Centrodeformacion $centro)
    {
        $regionales = Regionale::all();

        return view('centros.edit', compact('centro', 'regionales'));
    }

    /**
     * ACTUALIZAR
     */
    public function update(Request $request, Centrodeformacion $centro)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Observaciones' => 'nullable|string|max:200',
            'tbl_regionales_NIS' => 'required|integer|exists:tbl_regionales,NIS',
        ]);

        $centro->update($data);

        return redirect()
            ->route('centros.index')
            ->with('success', 'Centro actualizado correctamente');
    }

    /**
     * ELIMINAR
     */
    public function destroy(Centrodeformacion $centro)
    {
        $centro->delete();

        return redirect()
            ->route('centros.index')
            ->with('success', 'Centro eliminado correctamente');
    }
}
