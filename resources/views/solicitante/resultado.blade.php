<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Solicitante</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Datos del Solicitante</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <ul>
            <li>Tipo de Solicitante: {{ $datos['tipoSolicitante'] }}</li>
            <li>Documento: {{ $datos['documento'] }}</li>
            <li>Nombres: {{ $datos['nombres'] }}</li>
            <li>Primer Apellido: {{ $datos['primerApellido'] }}</li>
            <li>Segundo Apellido: {{ $datos['segundoApellido'] }}</li>
            <li>Tercer Apellido: {{ $datos['tercerApellido'] }}</li>
            <li>Dirección: {{ $datos['direccion'] }}</li>
        </ul>

        <h2>Documentos Adjuntos</h2>
        <div>
            <h3>Documento Anverso</h3>
            @if(isset($datos['documentoAnverso']))
            <img src="{{ $datos['documentoAnverso'] }}" alt="Documento Anverso" style="max-width: 100%; height: auto;">
            @else
            <p>No se ha adjuntado un documento anverso.</p>
            @endif

            <h3>Documento Reverso</h3>
            @if(isset($datos['documentoReverso']))
            <img src="{{ $datos['documentoReverso'] }}" alt="Documento Reverso" style="max-width: 100%; height: auto;">
            @else
            <p>No se ha adjuntado un documento reverso.</p>
            @endif
        </div>
    </div>
</body>

</html>