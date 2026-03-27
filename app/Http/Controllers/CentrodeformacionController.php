<?php

namespace App\Http\Controllers;

use App\Models\Centrodeformacion;
use App\Http\Requests\CentroFormacion\StoreCentroFormacionRequest;
use App\Http\Requests\CentroFormacion\UpdateCentroFormacionRequest;
use App\Services\CentroDeFormacionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class CentrodeformacionController extends Controller
{
    public function __construct(protected CentroDeFormacionService $service)
    {
    }

    public function index(): View
    {
        $centros = $this->service->listar();

        return view('centros.index', compact('centros'));
    }

    public function create(): View
    {
        $regionales = $this->service->datosDelFormulario()['regionales'];

        return view('centros.create', compact('regionales'));
    }

    public function store(StoreCentroFormacionRequest $request): RedirectResponse
    {
        try {
            $this->service->crear($request->validated());

            return redirect()->route('centros.index')
                ->with('success', 'Centro creado correctamente.');

        } catch (Throwable $e) {
            report($e);

            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo crear el centro. Intente nuevamente.');
        }
    }

    public function show(Centrodeformacion $centro): View
    {
        $centro = $this->service->verDetalles($centro);

        return view('centros.show', compact('centro'));
    }

    public function edit(Centrodeformacion $centro): View
    {
        $regionales = $this->service->datosDelFormulario()['regionales'];

        return view('centros.edit', compact('centro', 'regionales'));
    }

    public function update(UpdateCentroFormacionRequest $request, Centrodeformacion $centro): RedirectResponse
    {
        try {
            $this->service->actualizar($centro, $request->validated());

            return redirect()->route('centros.index')
                ->with('success', 'Centro actualizado correctamente.');

        } catch (Throwable $e) {
            report($e);

            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo actualizar el centro. Intente nuevamente.');
        }
    }

    public function destroy(Centrodeformacion $centro): RedirectResponse
    {
        try {
            $this->service->eliminar($centro);

            return redirect()->route('centros.index')
                ->with('success', 'Centro eliminado correctamente.');

        } catch (Throwable $e) {
            report($e);

            return redirect()->back()
                ->with('error', 'No se pudo eliminar el centro. Es posible que tenga aprendices asociados.');
        }
    }
}
