<?php

namespace App\Mail;

use App\Models\Archivo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/*
 Correo de notificación al subir una bitácora.
 Se envía al aprendiz (confirmación) y al instructor (notificación).
 */
class ArchivoMail extends Mailable
{
    use Queueable, SerializesModels;

    public Archivo $archivo;      

    public string $nombreUsuario;

    public ?string $descripcion;   

    public bool $esInstructor;     

    public string $fechaSubida;    

    public string $urlSistema;    

    public function __construct(
        Archivo $archivo,
        string $nombreUsuario,
        ?string $descripcion = null,
        bool $esInstructor = false
    ) {
        $this->archivo = $archivo;
        $this->nombreUsuario = $nombreUsuario;
        $this->descripcion = $descripcion;
        $this->esInstructor = $esInstructor;
        $this->fechaSubida = now()->format('d/m/Y H:i');
        $this->urlSistema = route('archivos.index');
    }

    /**
     * Asunto según destinatario:
     * Instructor → "Nueva bitácora de {nombre}"
     * Aprendiz   → "Confirmación de subida de tu bitácora"
     */
    public function envelope(): Envelope
    {
        $asunto = $this->esInstructor
            ? "Nueva bitácora de {$this->nombreUsuario}"
            : 'Confirmación de subida de tu bitácora';

        return new Envelope(subject: $asunto);
    }

    /**
     * Vista: resources/views/mail/archivo.blade.php
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.archivo',
            with: [
                'nombreArchivo' => $this->archivo->nombre_original,
                'nombreUsuario' => $this->nombreUsuario,
                'descripcion' => $this->descripcion,
                'fechaSubida' => $this->fechaSubida,
                'tamanoFormateado' => $this->archivo->tamano_formateado,
                'urlSistema' => $this->urlSistema,
                'esInstructor' => $this->esInstructor,
            ]
        );
    }

    /**
     * Adjunta el archivo físico al correo.
     * Retorna vacío si el archivo no existe.
     */
    public function attachments(): array
    {
        $rutaCompleta = storage_path('app/public/'.$this->archivo->ruta);

        if (! file_exists($rutaCompleta)) {
            return [];
        }

        return [
            Attachment::fromPath($rutaCompleta)
                ->as($this->archivo->nombre_original)
                ->withMime($this->archivo->tipo_mime),
        ];
    }
}
