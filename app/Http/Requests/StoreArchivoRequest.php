<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArchivoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'archivo' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
            'descripcion' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'archivo.required' => 'El archivo es obligatorio.',
            'archivo.file' => 'El campo debe ser un archivo válido.',
            'archivo.max' => 'El archivo no puede superar los 10MB.',
            'archivo.mimes' => 'El archivo debe ser de tipo: pdf, doc, docx, xls, xlsx, jpg, jpeg o png.',
            'descripcion.max' => 'La descripción no puede superar los 500 caracteres.',
        ];
    }
}
