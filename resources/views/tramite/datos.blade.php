<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Datos del Tramite</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f2f5;
            flex-direction: column;
        }

        .banner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 800px;
            background-image: url('{{ asset('bg.jpg') }}');
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 450px; 
            text-align: center;
        }

        .card h2 {
            font-size: 1.7rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        .card p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .card-icon {
            font-size: 3rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        .card-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card-button:hover {
            background-color: #218838;
        }

        .additional-images {
            display: flex;
            flex-direction: column; 
            align-items: center; 
            margin-bottom: 2rem;
        }

        .additional-images img {
            width: 80%; 
            max-width: 400px; 
            margin: 0.5rem 0; 
        }

        .additional-images img:first-of-type {
        width: 40%; 
        max-width: 200px;
        margin: 0.5rem 0;
    }
    .additional-images img:not(:first-of-type) {
        width: 80%;
        max-width: 400px;
        margin: 0.5rem 0;
    }
    </style>
</head>

<body>
    <div class="banner"></div>

    <div class="additional-images">
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_sc.png" alt="Imagen 1"> <!-- Reemplaza con la URL de tu primera imagen -->
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_tramite.png" alt="Imagen 2"> <!-- Reemplaza con la URL de tu segunda imagen -->
    </div>
    <div class="container mt-5">
        <div class="card">
        <h3>Datos Recuperados del Tramite</h3>
        <ul class="list-group">
            <li class="list-group-item"><strong>Código:</strong> {{ $tramite['codigo'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Fecha de solicitud:</strong> {{ $tramite['created_at']->format('Y-m-d') ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $tramite['estadoTramite']['nombre'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Válido hasta:</strong> {{ date('Y-m-d', strtotime($tramite['valido_hasta'])) ?? 'No disponible' }}</li>
        </ul>
        <br/>
        <h4>Datos del Solicitante</h4>
        <ul class="list-group">    
            <li class="list-group-item"><strong>Tipo:</strong> {{ $tramite['solicitante']['tipo'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Documento:</strong> {{ $tramite['solicitante']['nro_documento'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Nombres:</strong> {{ $tramite['solicitante']['nombres'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Primer Apellido:</strong> {{ $tramite['solicitante']['primer_apellido'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Segundo Apellido:</strong> {{ $tramite['solicitante']['segundo_apellido'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Tercer Apellido:</strong> {{ $tramite['solicitante']['tercer_apellido'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Dirección:</strong> {{ $tramite['solicitante']['direccion'] ?? 'No disponible' }}</li>
        </ul>
        </div>
    </div>
</body>

</html>