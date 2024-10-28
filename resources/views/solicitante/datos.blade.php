<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Datos del Solicitante</title>
</head>
<body>
    <div class="container mt-5">
        <h3>Datos Recuperados del Solicitante</h3>
        <ul class="list-group">
        <li class="list-group-item"><strong>Tipo:</strong> {{ $datos['tipo'] ?? 'No disponible' }}</li>
        <li class="list-group-item"><strong>Documento:</strong> {{ $datos['documento'] ?? 'No disponible' }}</li>
        <li class="list-group-item"><strong>Nombres:</strong> {{ $datos['nombres'] ?? 'No disponible' }}</li>
        <li class="list-group-item"><strong>Primer Apellido:</strong> {{ $datos['primerApellido'] ?? 'No disponible' }}</li>
        <li class="list-group-item"><strong>Segundo Apellido:</strong> {{ $datos['segundoApellido'] ?? 'No disponible' }}</li>
        <li class="list-group-item"><strong>Tercer Apellido:</strong> {{ $datos['tercerApellido'] ?? 'No disponible' }}</li>
        <li class="list-group-item"><strong>Dirección:</strong> {{ $datos['direccion'] ?? 'No disponible' }}</li>

        </ul>
    </div>
</body>
</html>
