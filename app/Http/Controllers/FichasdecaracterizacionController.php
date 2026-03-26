<?php

namespace App\Http\Controllers;

use App\Models\Fichadecaracterizacion;
use App\Models\Instructore;
use App\Models\Programasdeformacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FichasdecaracterizacionController extends Controller
{
    /**
     * Listado de fichas con paginación
     */
    public function index()
    {
        $fichas = Fichadecaracterizacion::with(['instructor', 'programaDeFormacion'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('fichas.index', compact('fichas'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {

        $instructores = Instructore::orderBy('Nombres')
            ->get()
            ->mapWithKeys(function ($instructor) {
                $nombreCompleto = $instructor->Nombres . ' ' . $instructor->Apellidos;
                return [$instructor->NIS => $nombreCompleto];
            })
            ->prepend('Seleccione un instructor', '');


        $programas = Programasdeformacion::orderBy('Denominacion')
            ->pluck('Denominacion', 'NIS')
            ->prepend('Seleccione un programa', '');

        return view('fichas.create', compact('instructores', 'programas'));
    }

    /**
     * Guardar nueva ficha
     */
    public function store(Request $request)
    {
        $messages = [
            'Codigo.unique' => 'El código de ficha ya existe en el sistema.',
            'Codigo.required' => 'El código de ficha es obligatorio.',
            'Codigo.integer' => 'El código debe ser un número entero.',
            'Denominacion.required' => 'La denominación es obligatoria.',
            'Denominacion.max' => 'La denominación no puede exceder los 100 caracteres.',
            'Cupo.required' => 'El cupo es obligatorio.',
            'Cupo.min' => 'El cupo debe ser al menos 1.',
            'FechaInicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'FechaFin.date' => 'La fecha de fin debe ser una fecha válida.',
            'FechaFin.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
            'tbl_instructores_NIS.required' => 'Debe seleccionar un instructor.',
            'tbl_instructores_NIS.exists' => 'El instructor seleccionado no existe.',
            'tbl_programasdeformacion_NIS.required' => 'Debe seleccionar un programa.',
            'tbl_programasdeformacion_NIS.exists' => 'El programa seleccionado no existe.',
            'Observaciones.max' => 'Las observaciones no pueden exceder los 200 caracteres.',
        ];

        $validated = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_fichadecaracterizacion,Codigo',
            'Denominacion' => 'required|string|max:100',
            'Cupo' => 'required|integer|min:1',
            'FechaInicio' => 'nullable|date',
            'FechaFin' => 'nullable|date|after_or_equal:FechaInicio',
            'Observaciones' => 'nullable|string|max:200',
            'tbl_instructores_NIS' => 'required|integer|exists:tbl_instructores,NIS',
            'tbl_programasdeformacion_NIS' => 'required|integer|exists:tbl_programasdeformacion,NIS',
        ], $messages);

        try {
            DB::beginTransaction();
            $ficha = Fichadecaracterizacion::create($validated);
            DB::commit();

            return redirect()
                ->route('fichas.index')
                ->with('success', "Ficha {$ficha->Codigo} creada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear la ficha: ' . $e->getMessage());
        }
    }

    /**
     * Ver detalle de una ficha específica
     */
    public function show(Fichadecaracterizacion $ficha)
    {
        return view('fichas.show', compact('ficha'));
    }

    /**
     * Formulario de edición
     */
    public function edit(Fichadecaracterizacion $ficha)
    {

        $instructores = Instructore::orderBy('Nombres')
            ->get()
            ->mapWithKeys(function ($instructor) {
                $nombreCompleto = $instructor->Nombres . ' ' . $instructor->Apellidos;
                return [$instructor->NIS => $nombreCompleto];
            })
            ->prepend('Seleccione un instructor', '');

        $programas = Programasdeformacion::orderBy('Denominacion')
            ->pluck('Denominacion', 'NIS')
            ->prepend('Seleccione un programa', '');

        return view('fichas.edit', compact('ficha', 'instructores', 'programas'));
    }

    /**
     * Actualizar ficha existente
     */
    public function update(Request $request, Fichadecaracterizacion $ficha)
    {
        $messages = [
            'Codigo.unique' => 'El código de ficha ya existe en el sistema.',
            'Codigo.required' => 'El código de ficha es obligatorio.',
            'Codigo.integer' => 'El código debe ser un número entero.',
            'Denominacion.required' => 'La denominación es obligatoria.',
            'Denominacion.max' => 'La denominación no puede exceder los 100 caracteres.',
            'Cupo.required' => 'El cupo es obligatorio.',
            'Cupo.min' => 'El cupo debe ser al menos 1.',
            'FechaInicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'FechaFin.date' => 'La fecha de fin debe ser una fecha válida.',
            'FechaFin.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
            'tbl_instructores_NIS.required' => 'Debe seleccionar un instructor.',
            'tbl_instructores_NIS.exists' => 'El instructor seleccionado no existe.',
            'tbl_programasdeformacion_NIS.required' => 'Debe seleccionar un programa.',
            'tbl_programasdeformacion_NIS.exists' => 'El programa seleccionado no existe.',
            'Observaciones.max' => 'Las observaciones no pueden exceder los 200 caracteres.',
        ];

        $validated = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_fichadecaracterizacion,Codigo,' . $ficha->NIS . ',NIS',
            'Denominacion' => 'required|string|max:100',
            'Cupo' => 'required|integer|min:1',
            'FechaInicio' => 'nullable|date',
            'FechaFin' => 'nullable|date|after_or_equal:FechaInicio',
            'Observaciones' => 'nullable|string|max:200',
            'tbl_instructores_NIS' => 'required|integer|exists:tbl_instructores,NIS',
            'tbl_programasdeformacion_NIS' => 'required|integer|exists:tbl_programasdeformacion,NIS',
        ], $messages);

        try {
            DB::beginTransaction();
            $ficha->update($validated);
            DB::commit();

            return redirect()
                ->route('fichas.index')
                ->with('success', "Ficha {$ficha->Codigo} actualizada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar la ficha: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar ficha
     */
    public function destroy(Fichadecaracterizacion $ficha)
    {
        try {
            DB::beginTransaction();
            $codigoFicha = $ficha->Codigo;
            $ficha->delete();
            DB::commit();

            return redirect()
                ->route('fichas.index')
                ->with('success', "Ficha {$codigoFicha} eliminada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('fichas.index')
                ->with('error', 'Error al eliminar la ficha: ' . $e->getMessage());
        }
    }
}
