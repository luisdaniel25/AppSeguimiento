<?php

namespace App\Http\Controllers;


use App\Models\Eps;
use App\Models\Instructore;
use App\Models\Tiposdocumento;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InstructoresController extends Controller
{
    /**
     * Mostrar listado de instructores
     */
    public function index()
    {
        $instructores = Instructore::with([
            'tiposdocumento',
            'eps',
        ])
            ->orderBy('NIS')
            ->paginate(10);

        return view('Instructores.index', compact('instructores'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $tiposdoc = Tiposdocumento::all();
        $listaEps = Eps::all();

        return view('Instructores.create', compact('tiposdoc', 'listaEps'));
    }

    /**
     * Guardar nuevo instructor
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_instructores,NumDoc',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'CorreoPersonal' => 'required|email|max:50',
            'Sexo' => 'required|integer|in:1,2',
            'FechaNac' => 'required|date',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_eps_nis' => 'required|integer|exists:tbl_eps,nis',
        ]);

        Instructore::create($data);

        Alert::success('¡Creado!', 'El instructor se ha registrado correctamente.');

        return redirect()->route('instructores.index');
    }

    /**
     * Mostrar detalle de un instructor
     */
    public function show(Instructore $instructore)
    {
        $instructore->load([
            'tiposdocumento',
            'eps',
        ]);

        return view('Instructores.show', [
            'instructor' => $instructore
        ]);
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Instructore $instructore)
    {
        $tiposdoc = Tiposdocumento::all();
        $listaEps = Eps::all();

        return view('Instructores.edit', [
            'instructor' => $instructore,
            'tiposdoc' => $tiposdoc,
            'listaEps' => $listaEps
        ]);
    }

    /**
     * Actualizar instructor
     */
    public function update(Request $request, Instructore $instructore)
    {
        $data = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_instructores,NumDoc,' . $instructore->NIS . ',NIS',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'CorreoPersonal' => 'required|email|max:50',
            'Sexo' => 'required|integer|in:1,2',
            'FechaNac' => 'required|date',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_eps_nis' => 'required|integer|exists:tbl_eps,nis',





        ]);

        $instructore->update($data);

        Alert::info('¡Actualizado!', 'El instructor se ha modificado correctamente.');

        return redirect()->route('instructores.index');
    }

    /**
     * Eliminar instructor
     */
    public function destroy(Instructore $instructore)
    {
        $instructore->delete();

        Alert::warning('¡Eliminado!', 'El instructor se ha eliminado correctamente.');

        return redirect()->route('instructores.index');
    }
}
