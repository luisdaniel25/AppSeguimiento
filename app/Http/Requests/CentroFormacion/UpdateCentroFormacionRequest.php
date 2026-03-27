<?php

namespace App\Http\Requests\CentroFormacion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCentroFormacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $nisActual = $this->route('centro')->NIS;

        return [
            'Codigo' => [
                'sometimes',
                'integer',
                // Ignora el propio registro al verificar unicidad
                Rule::unique('tbl_centrodeformacion', 'Codigo')->ignore($nisActual, 'NIS'),
            ],
            'Denominacion'       => 'sometimes|string|max:100',
            'Direccion'          => 'sometimes|string|max:200',
            'Observaciones'      => 'nullable|string|max:200',
            'tbl_regionales_NIS' => 'sometimes|integer|exists:tbl_regionales,NIS',
        ];
    }

    public function messages(): array
    {
        return [
            'Codigo.integer'             => 'El código debe ser un número entero.',
            'Codigo.unique'              => 'Este código ya está registrado por otro centro.',
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
