<?php

namespace App\Http\Controllers;


use App\Models\Rolesadministrativo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RolesadministrativosController extends Controller
{
    /**
     * Mostrar listado de roles administrativos
     */
    public function index()
    {
        $roles = Rolesadministrativo::orderBy('NIS')->paginate(10);

        return view('Rolesadministrativos.index', compact('roles'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('Rolesadministrativos.create');
    }

    /**
     * Guardar nuevo rol administrativo
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Descripcion' => 'required|string|max:255',
        ]);

        Rolesadministrativo::create($data);

        Alert::success('¡Creado!', 'El rol administrativo se ha registrado correctamente.');

        return redirect()->route('rolesadministrativos.index');
    }

    /**
     * Mostrar detalle de un rol administrativo
     */
    public function show(Rolesadministrativo $rolesadministrativo)
    {
        return view('Rolesadministrativos.show', compact('rolesadministrativo'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Rolesadministrativo $rolesadministrativo)
    {
        return view('Rolesadministrativos.edit', compact('rolesadministrativo'));
    }

    /**
     * Actualizar rol administrativo
     */
    public function update(Request $request, Rolesadministrativo $rolesadministrativo)
    {
        $data = $request->validate([
            'Descripcion' => 'required|string|max:255',
        ]);

        $rolesadministrativo->update($data);

        Alert::info('¡Actualizado!', 'El rol administrativo se ha modificado correctamente.');

        return redirect()->route('rolesadministrativos.index');
    }

    /**
     * Eliminar rol administrativo
     */
    public function destroy(Rolesadministrativo $rolesadministrativo)
    {
        $rolesadministrativo->delete();

        Alert::warning('¡Eliminado!', 'El rol administrativo se ha eliminado correctamente.');

        return redirect()->route('rolesadministrativos.index');
    }
}
