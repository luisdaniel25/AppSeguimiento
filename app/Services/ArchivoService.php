<?php

namespace App\Services;

use App\Mail\ArchivoMail;
use App\Models\Aprendice;
use App\Models\Archivo;
use App\Models\FichaDeCaracterizacion;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArchivoService
{
    public function listar(int $porPagina = 10)
    {
        return Archivo::with('aprendiz')
            ->orderBy('created_at', 'desc')
            ->paginate($porPagina);
    }

    public function buscarAprendizPorCorreo(string $email): ?Aprendice
    {
        return Aprendice::where('CorreoInstitucional', $email)
            ->orWhere('CorreoPersonal', $email)
            ->first();
    }

    public function buscarAprendizPorCorreoOFallar(string $email): Aprendice
    {
        return Aprendice::where('CorreoInstitucional', $email)
            ->orWhere('CorreoPersonal', $email)
            ->firstOrFail();
    }

    // ── Crear carpeta base ─────────────────────────────
    public function asegurarCarpetaExiste(): void
    {
        if (!Storage::disk('public')->exists('archivos')) {
            Storage::disk('public')->makeDirectory('archivos');
            Storage::disk('public')->put('archivos/.gitignore', "*\n!.gitignore");
        }
    }

    // ── Guardar archivo (PRO) ─────────────────────────
    public function guardar(UploadedFile $file, ?string $descripcion, int $aprendizNIS): Archivo
    {
        $this->asegurarCarpetaExiste();

        //  Obtener aprendiz
        $aprendiz = Aprendice::where('NIS', $aprendizNIS)->firstOrFail();

        //  Crear nombre limpio (slug)
        $nombreLimpio = Str::slug($aprendiz->Nombres . '-' . $aprendiz->Apellidos);

        //  Carpeta: ID + nombre
        $carpeta = 'archivos/' . $aprendizNIS . '-' . $nombreLimpio;

        // Crear carpeta si no existe
        if (!Storage::disk('public')->exists($carpeta)) {
            Storage::disk('public')->makeDirectory($carpeta);
        }

        $extension = $file->getClientOriginalExtension();

        //  Nombre único
        $nombreGuardado = time() . '_' . uniqid() . '.' . $extension;

        // Guardar archivo
        $ruta = $file->storeAs($carpeta, $nombreGuardado, 'public');

        return Archivo::create([
            'nombre_original'      => $file->getClientOriginalName(),
            'nombre_guardado'      => $nombreGuardado,
            'ruta'                 => $ruta,
            'tipo_mime'            => $file->getMimeType(),
            'tamano'               => $file->getSize(),
            'descripcion'          => $descripcion,
            'tbl_aprendices_NIS'   => $aprendizNIS,
        ]);
    }

    // ── Enviar correos ────────────────────────────────
    public function enviarCorreos(Archivo $archivo, Aprendice $aprendiz, ?string $descripcion): void
    {
        $rutaCompleta = storage_path('app/public/' . $archivo->ruta);

        if (!file_exists($rutaCompleta)) {
            Log::error('Archivo no encontrado: ' . $rutaCompleta);
            return;
        }

        $nombreCompleto = $aprendiz->Nombres . ' ' . $aprendiz->Apellidos;

        $this->enviarCorreoAprendiz($archivo, $aprendiz, $nombreCompleto, $descripcion);
        $this->enviarCorreoInstructor($archivo, $aprendiz, $nombreCompleto, $descripcion);
    }

    private function enviarCorreoAprendiz(Archivo $archivo, Aprendice $aprendiz, string $nombreCompleto, ?string $descripcion): void
    {
        $correo = $aprendiz->CorreoInstitucional ?? $aprendiz->CorreoPersonal;

        if (!$correo) {
            Log::error('El aprendiz no tiene correo registrado.');
            return;
        }

        Mail::to($correo)->queue(
            new ArchivoMail($archivo, $nombreCompleto, $descripcion, false)
        );

        Log::info('Correo encolado para aprendiz: ' . $correo);
    }

    private function enviarCorreoInstructor(Archivo $archivo, Aprendice $aprendiz, string $nombreCompleto, ?string $descripcion): void
    {
        $ficha = FichaDeCaracterizacion::where(
            'tbl_programasdeformacion_NIS',
            $aprendiz->tbl_programasdeformacion_NIS
        )->first();

        if (!$ficha) {
            Log::error('Ficha de caracterización no encontrada.');
            return;
        }

        $instructor = $ficha->instructor ?? null;

        if (!$instructor) {
            Log::error('Instructor no encontrado.');
            return;
        }

        if (!$instructor->CorreoInstitucional) {
            Log::error('Instructor sin correo.');
            return;
        }

        Mail::to($instructor->CorreoInstitucional)->queue(
            new ArchivoMail($archivo, $nombreCompleto, $descripcion, true)
        );

        Log::info('Correo encolado para instructor: ' . $instructor->CorreoInstitucional);
    }

    // ── Ruta completa ────────────────────────────────
    public function rutaCompleta(Archivo $archivo): string
    {
        return storage_path('app/public/' . $archivo->ruta);
    }

    // ── Eliminar archivo ─────────────────────────────
    public function eliminar(Archivo $archivo): void
    {
        if (Storage::disk('public')->exists($archivo->ruta)) {
            Storage::disk('public')->delete($archivo->ruta);
        }

        $archivo->delete();
    }

    //  Eliminar todos los archivos de un aprendiz
    public function eliminarPorAprendiz(int $aprendizNIS): void
    {
        $aprendiz = Aprendice::where('NIS', $aprendizNIS)->first();

        if (!$aprendiz) return;

        $nombreLimpio = Str::slug($aprendiz->Nombres . '-' . $aprendiz->Apellidos);

        $carpeta = 'archivos/' . $aprendizNIS . '-' . $nombreLimpio;

        Storage::disk('public')->deleteDirectory($carpeta);
    }
}
