<?php

namespace App\Http\Requests\Aprendiz;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAprendiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $nis = $this->route('aprendice')?->NIS;

        return [
            'NumDoc' => 'required|integer|unique:tbl_aprendices,NumDoc,'.$nis.',NIS',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'CorreoPersonal' => 'required|email|max:50',
            'Sexo' => 'required|integer|in:1,2',
            'FechaNac' => 'required|date',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_programasdeformacion_NIS' => 'required|integer|exists:tbl_programasdeformacion,NIS',
            'tbl_centrodeformacion_NIS' => 'required|integer|exists:tbl_centrodeformacion,NIS',
            'tbl_eps_nis' => 'required|integer|exists:tbl_eps,nis',
        ];
    }

    public function messages(): array
    {
        return [
            'NumDoc.required' => 'El número de documento es obligatorio.',
            'NumDoc.unique' => 'Este número de documento ya está registrado.',
            'Nombres.required' => 'Los nombres son obligatorios.',
            'Apellidos.required' => 'Los apellidos son obligatorios.',
            'Direccion.required' => 'La dirección es obligatoria.',
            'Telefono.required' => 'El teléfono es obligatorio.',
            'CorreoInstitucional.required' => 'El correo institucional es obligatorio.',
            'CorreoInstitucional.email' => 'El correo institucional debe tener un formato válido.',
            'CorreoPersonal.required' => 'El correo personal es obligatorio.',
            'CorreoPersonal.email' => 'El correo personal debe tener un formato válido.',
            'Sexo.required' => 'El sexo es obligatorio.',
            'Sexo.in' => 'El valor de sexo no es válido.',
            'FechaNac.required' => 'La fecha de nacimiento es obligatoria.',
            'FechaNac.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'tbl_tiposdocumentos_nis.required' => 'El tipo de documento es obligatorio.',
            'tbl_tiposdocumentos_nis.exists' => 'El tipo de documento seleccionado no existe.',
            'tbl_programasdeformacion_NIS.required' => 'El programa de formación es obligatorio.',
            'tbl_programasdeformacion_NIS.exists' => 'El programa de formación seleccionado no existe.',
            'tbl_centrodeformacion_NIS.required' => 'El centro de formación es obligatorio.',
            'tbl_centrodeformacion_NIS.exists' => 'El centro de formación seleccionado no existe.',
            'tbl_eps_nis.required' => 'La EPS es obligatoria.',
            'tbl_eps_nis.exists' => 'La EPS seleccionada no existe.',
        ];
    }
}
