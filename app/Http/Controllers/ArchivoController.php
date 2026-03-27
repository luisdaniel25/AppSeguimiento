<?php

namespace App\Http\Controllers;

use App\Http\Requests\Archivo\StoreArchivoRequest;
use App\Models\Archivo;
use App\Services\ArchivoService;
use Illuminate\Support\Facades\Auth;

class ArchivoController extends Controller
{
    public function __construct(
        private readonly ArchivoService $service
    ) {}

    /**
     * Responsabilidad: devolver la vista del listado paginado.
     */
    public function index()
    {
        $archivos = $this->service->listar();

        return view('archivos.index', compact('archivos'));
    }

    /**
     * Responsabilidad: devolver la vista de creación con el aprendiz autenticado.
     */
    public function create()
    {
        $aprendiz = null;
        $usuario = Auth::user();

        if ($usuario) {
            $aprendiz = $this->service->buscarAprendizPorCorreo($usuario->email);
        }

        return view('archivos.create', compact('aprendiz'));
    }

    /**
     * Responsabilidad: delegar el guardado al servicio y redirigir.
     * La validación la maneja StoreArchivoRequest automáticamente.
     */
    public function store(StoreArchivoRequest $request)
    {
        $aprendiz = $this->service->buscarAprendizPorCorreoOFallar(Auth::user()->email);

        $archivo = $this->service->guardar(
            $request->file('archivo'),
            $request->descripcion,
            $aprendiz->NIS
        );

        $this->service->enviarCorreos($archivo, $aprendiz, $request->descripcion);

        return redirect()->route('archivos.index')
            ->with('success', 'Bitácora subida correctamente');
    }

    /**
     * Responsabilidad: servir el archivo en el navegador.
     */
    public function show($id)
    {
        $archivo = Archivo::findOrFail($id);
        $rutaCompleta = $this->service->rutaCompleta($archivo);

        if (! file_exists($rutaCompleta)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file($rutaCompleta);
    }

    /**
     * Responsabilidad: descargar el archivo con su nombre original.
     */
    public function download($id)
    {
        $archivo = Archivo::findOrFail($id);
        $rutaCompleta = $this->service->rutaCompleta($archivo);

        if (! file_exists($rutaCompleta)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->download($rutaCompleta, $archivo->nombre_original);
    }

    /**
     * Responsabilidad: delegar la eliminación al servicio y redirigir.
     */
    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);

        $this->service->eliminar($archivo);

        return redirect()->route('archivos.index')
            ->with('success', 'Archivo eliminado correctamente');
    }
}
