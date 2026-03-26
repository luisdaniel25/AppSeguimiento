<?php

namespace App\Http\Controllers;


use App\Models\Entecoformadore;
use App\Models\Rolesadministrativo;
use App\Models\Tiposdocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class EnteconformadorController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $enteconformador = Entecoformadore::with([
            'rolesadministrativo',
            'tiposdocumento',
        ])
            ->orderBy('NIS')
            ->paginate(10);

        // DEBUG
        Log::info('Listado EnteConformador cargado', [
            'total_registros' => $enteconformador->total()
        ]);

        return view('enteconformador.index', compact('enteconformador'));
    }

    /**
     * Crear
     */
    public function create()
    {
        $listaTiposDocumentos = Tiposdocumento::all();
        $listaRoles = Rolesadministrativo::all();

        //Log::info('Formulario create abierto');
        Log::info('DEBUG CREATE - Tipos Documento:', $listaTiposDocumentos->toArray());
        Log::info('DEBUG CREATE - Roles:', $listaRoles->toArray());

        return view('enteconformador.create', compact(
            'listaTiposDocumentos',
            'listaRoles'
        ));
    }

    /**
     * Guardar
     */
    public function store(Request $request)
    {
        // Ver qué llega del formulario
        Log::info('Datos recibidos STORE', $request->all());

        $data = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_entecoformadores,NumDoc',
            'RazonSocial' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_rolesadministrativos_NIS' => 'required|integer|exists:tbl_rolesadministrativos,nis',
        ]);

        Log::info('Datos validados STORE', $data);

        $nuevo = Entecoformadore::create($data);

        Log::info('Registro creado correctamente', [
            'NIS' => $nuevo->NIS,
            'Empresa' => $nuevo->RazonSocial
        ]);

        Alert::success('¡Creado!', 'El Ente Conformador se ha registrado correctamente.');

        return redirect()->route('enteconformador.index');
    }

    /**
     * Mostrar detalle
     */
    public function show(Entecoformadore $enteconformador)
    {
        // Carga las relaciones
        $enteconformador->load([
            'rolesadministrativo',
            'tiposdocumento',
        ]);

        // DEBUG
        Log::info('DEBUG COMPLETO - Ente Conformador', [
            'ID' => $enteconformador->NIS,
            'Empresa' => $enteconformador->RazonSocial,
            'Documento' => $enteconformador->NumDoc,
            'tbl_rolesadministrativos_NIS' => $enteconformador->tbl_rolesadministrativos_NIS,
            'tbl_tiposdocumentos_nis' => $enteconformador->tbl_tiposdocumentos_nis,
            'Rol_object' => $enteconformador->rolesadministrativo,
            'TipoDocumento_object' => $enteconformador->tiposdocumento,
        ]);

        // Veo todo lo que llega a la vista ver TODO
        //dd($enteconformador->toArray());

        return view('enteconformador.show', compact('enteconformador'));
    }

    /**
     * Editar
     */
    public function edit(Entecoformadore $enteconformador)
    {
        $listaTiposDocumentos = Tiposdocumento::all();
        $listaRoles = Rolesadministrativo::all();

        Log::info('Editando registro', [
            'NIS' => $enteconformador->NIS
        ]);

        return view('enteconformador.edit', compact(
            'enteconformador',
            'listaTiposDocumentos',
            'listaRoles'
        ));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, Entecoformadore $enteconformador)
    {
        Log::info('Datos recibidos UPDATE', $request->all());

        $data = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_entecoformadores,NumDoc,' . $enteconformador->NIS . ',NIS',
            'RazonSocial' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_rolesadministrativos_NIS' => 'required|integer|exists:tbl_rolesadministrativos,nis',
        ]);

        $enteconformador->update($data);

        Log::info('Registro actualizado', [
            'NIS' => $enteconformador->NIS
        ]);

        Alert::info('¡Actualizado!', 'El Ente Conformador se ha modificado correctamente.');

        return redirect()->route('enteconformador.index');
    }

    /**
     * Eliminar
     */
    public function destroy(Entecoformadore $enteconformador)
    {
        Log::warning('Registro eliminado', [
            'NIS' => $enteconformador->NIS,
            'Empresa' => $enteconformador->RazonSocial
        ]);

        $enteconformador->delete();

        Alert::warning('¡Eliminado!', 'El Ente Conformador se ha eliminado correctamente.');

        return redirect()->route('enteconformador.index');
    }
}
