<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bitácora</title>
    <style>
        /* Estilos base del correo */
        body        { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container  { background: #ffffff; max-width: 600px; margin: auto; padding: 30px; border-radius: 8px; }
        h2          { color: #333333; border-bottom: 2px solid #eeeeee; padding-bottom: 10px; }
        ul          { background: #f9f9f9; padding: 20px; border-radius: 6px; list-style: none; }
        li          { padding: 5px 0; color: #555555; }
        a           { color: #4A90E2; text-decoration: none; font-weight: bold; }
        .footer     { margin-top: 20px; font-size: 12px; color: #aaaaaa; text-align: center; }
    </style>
</head>
<body>
<div class="container">

   
    {{-- CORREO AL INSTRUCTOR              --}}
    {{-- Notifica nueva bitácora subida    --}}
    @if($esInstructor)

        <h2> Notificación de nueva bitácora</h2>
        <p>El aprendiz <strong>{{ $nombreUsuario }}</strong> ha subido una nueva bitácora.</p>

        <ul>
            <li><strong>Archivo:</strong> {{ $nombreArchivo }}</li>
            <li><strong>Descripción:</strong> {{ $descripcion ?? 'Sin descripción' }}</li>
            <li><strong>Tamaño:</strong> {{ $tamanoFormateado }}</li>
            <li><strong>Fecha de subida:</strong> {{ $fechaSubida }}</li>
        </ul>

        <p>Revisa todos los archivos en el sistema:<br>
            <a href="{{ $urlSistema }}">Ver bitácoras</a>
        </p>
    
    {{-- CORREO AL APRENDIZ                --}}
    {{-- Confirmación de subida exitosa    --}}
  
    @else

        <h2> Confirmación de subida de bitácora</h2>
        <p>Hola <strong>{{ $nombreUsuario }}</strong>, tu bitácora se ha subido correctamente.</p>

        <ul>
            <li><strong>Archivo:</strong> {{ $nombreArchivo }}</li>
            <li><strong>Descripción:</strong> {{ $descripcion ?? 'Sin descripción' }}</li>
            <li><strong>Tamaño:</strong> {{ $tamanoFormateado }}</li>
            <li><strong>Fecha de subida:</strong> {{ $fechaSubida }}</li>
        </ul>

        <p>Puedes revisar tu bitácora en el sistema:<br>
            <a href="{{ $urlSistema }}">Ver bitácoras</a>
        </p>

    @endif

    {{-- Pie de página --}}
    <div class="footer">
        Este correo fue generado automáticamente, por favor no respondas a este mensaje.
    </div>

</div>
</body>
</html>