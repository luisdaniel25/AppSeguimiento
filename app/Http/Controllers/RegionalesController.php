<?php

// app/Http/Controllers/RegionaleController.php

namespace App\Http\Controllers;


use App\Models\Regionale;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegionalesController extends Controller
{
    public function index()
    {
        $regionales = Regionale::orderBy('NIS')->paginate(10);

        return view('Regionales.index', compact('regionales'));
    }

    public function create()
    {
        return view('Regionales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:255',
            'Observaciones' => 'nullable|string',
        ]);

        // Crear registro
        Regionale::create($validated);

        // Mostrar alerta de éxito
        Alert::success('Muy Bien', 'Regional creada exitosamente.');

        // Redirigir al listado
        return redirect()->route('regionales.index');
    }

    public function show(Regionale $regionale)
    {
        return view('Regionales.show', compact('regionale'));
    }

    public function edit(Regionale $regionale)
    {
        return view('Regionales.edit', compact('regionale'));
    }

    public function update(Request $request, Regionale $regionale)
    {
        $validated = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:255',
            'Observaciones' => 'nullable|string',
        ]);

        $regionale->update($validated);

        return redirect()->route('regionales.index')
            ->with('success', 'Regional actualizada exitosamente.');
    }

    public function destroy(Regionale $regionale)
    {
        $regionale->delete();

        return redirect()->route('regionales.index')
            ->with('success', 'Regional eliminada exitosamente.');
    }
}
