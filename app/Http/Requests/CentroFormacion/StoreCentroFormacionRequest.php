<?php

namespace App\Http\Requests\CentroFormacion;

use Illuminate\Foundation\Http\FormRequest;

class StoreCentroFormacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Codigo'             => 'required|integer|unique:tbl_centrodeformacion,Codigo',
            'Denominacion'       => 'required|string|max:100',
            'Direccion'          => 'required|string|max:200',
            'Observaciones'      => 'nullable|string|max:200',
            'tbl_regionales_NIS' => 'required|integer|exists:tbl_regionales,NIS',
        ];
    }

    public function messages(): array
    {
        return $this->mensajesComunes() + [
                'Codigo.required'            => 'El código es obligatorio.',
                'Codigo.unique'              => 'Este código ya está registrado.',
                'Denominacion.required'      => 'La denominación es obligatoria.',
                'Direccion.required'         => 'La dirección es obligatoria.',
                'tbl_regionales_NIS.required'=> 'La regional es obligatoria.',
            ];
    }

    private function mensajesComunes(): array
    {
        return [
            'Codigo.integer'             => 'El código debe ser un número entero.',
            'Denominacion.string'        => 'La denominación debe ser texto.',
            'Denominacion.max'           => 'La denominación no puede exceder 100 caracteres.',
            'Direccion.string'           => 'La dirección debe ser texto.',
            'Direccion.max'              => 'La dirección no puede exceder 200 caracteres.',
            'Observaciones.string'       => 'Las observaciones deben ser texto.',
            'Observaciones.max'          => 'Las observaciones no pueden exceder 200 caracteres.',
            'tbl_regionales_NIS.integer' => 'La regional debe ser un número.',
            'tbl_regionales_NIS.exists'  => 'La regional seleccionada no existe.',
        ];
    }
}
