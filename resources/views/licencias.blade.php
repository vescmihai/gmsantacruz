<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Autenticación con MetaMask</title>
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
            overflow-y: auto; 
        }

        .banner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; 
            background-image: url('{{ asset('bg.jpg') }}');
            background-size: cover;
            background-position: center;
            z-index: -1;
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

        .container {
            display: grid; 
            grid-template-columns: repeat(2, 1fr); 
            gap: 2rem; 
            margin-top: 2rem;
            padding: 1rem; 
            max-width: 1000px; 
            width: 100%; 
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 450px; 
            margin: 0; 
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
            text-decoration: none; 
            display: inline-block; 
        }

        .card-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="banner"></div>

    <div class="additional-images">
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_sc.png" alt="Imagen 1">
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_tramite.png" alt="Imagen 2">
    </div>

    <div class="container">
        @foreach ($tipos as $tipo)
        {{-- Cards --}}
        <div class="card">
            <div class="card-icon">{!! $tipo->icono !!}</div> <!-- Documento -->
            <h2>{{ $tipo->nombre }}</h2>
            <p>{{ $tipo->descripcion }}</p>
            <a href="{{ route('tipo', ['codigo' => $tipo->codigo]) }}" class="card-button">Ingresar</a>
        </div>
        @endforeach
    </div>
</body>
</html>
