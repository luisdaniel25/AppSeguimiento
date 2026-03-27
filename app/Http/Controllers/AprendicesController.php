<?php

namespace App\Http\Controllers;



use App\Http\Requests\Aprendiz\StoreAprendiceRequest;
use App\Http\Requests\Aprendiz\UpdateAprendiceRequest;
use App\Models\Aprendice;
use App\Services\AprendiceService;
use RealRashid\SweetAlert\Facades\Alert;

class AprendicesController extends Controller
{
    // El servicio contiene toda la lógica de negocio;
    // el controlador solo lo llama y devuelve respuestas.
    public function __construct(
        private readonly AprendiceService $service // Laravel inyecta esta dependencia automáticamente
    ) {}

    public function index()
    {
        // Delega al servicio la consulta y devuelve la colección lista
        $aprendices = $this->service->listar();

        // Pasa la colección a la vista como variable $aprendices
        return view('Aprendices.index', compact('aprendices'));
    }

    public function create()
    {
        // Obtiene datos auxiliares para los selectores del formulario (fichas, programas, etc.)
        $datos = $this->service->datosdelformulario();
        // $datos es un array asociativo, se expande como variables individuales en la vista
        return view('Aprendices.create', $datos);
    }

    public function store(StoreAprendiceRequest $request)
    {
        // En este punto los datos ya fueron validados por StoreAprendiceRequest;
        // si la validación falló, Laravel nunca llegó aquí.
        $this->service->crear($request->validated()); // Solo pasa los campos validados, nunca datos crudos

        // Flashea una notificación SweetAlert que la vista mostrará tras la redirección
        Alert::success('Muy Bien', 'Aprendiz creado exitosamente.');

        return redirect()->route('aprendices.index');
    }

    public function show(Aprendice $aprendice)
    {
        // Laravel resolvió $aprendice automáticamente por el ID en la URL (Route Model Binding)
        // El servicio carga las relaciones necesarias (eager loading) antes de enviarlo a la vista
        $aprendice = $this->service->ver_detalles($aprendice);

        return view('Aprendices.show', compact('aprendice'));
    }

    public function edit(Aprendice $aprendice)
    {
        // Obtiene los datos auxiliares del formulario (mismos selectores que en create)
        $datos = $this->service->datosdelformulario();

        // array_merge une el aprendiz actual con los datos del formulario
        // para pasarlos todos juntos a la vista en un solo array
        return view('Aprendices.edit', array_merge(
            compact('aprendice'), // modelo actual para pre-llenar los campos
            $datos                // datos auxiliares para los selectores
        ));
    }

    public function update(UpdateAprendiceRequest $request, Aprendice $aprendice)
    {
        // UpdateAprendiceRequest ya validó los datos antes de entrar aquí
        // Se pasa el modelo y los datos validados; el servicio decide qué actualizar
        $this->service->actualizar($aprendice, $request->validated());

        Alert::success('Muy Bien', 'Aprendiz actualizado exitosamente.');

        return redirect()->route('aprendices.index');
    }

    public function destroy(Aprendice $aprendice)
    {
        // El servicio maneja la eliminación (puede incluir soft delete, logs, etc.)
        $this->service->eliminar($aprendice);

        Alert::success('Muy Bien', 'Aprendiz eliminado exitosamente.');

        // Regresa al listado tras eliminar
        return redirect()->route('aprendices.index');
    }
}
