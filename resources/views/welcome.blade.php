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
    .card-alert {
        background: red;
        font-size: bold;
    }
    </style>
</head>
<body>
    <div class="banner"></div>

    <div class="additional-images">
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_sc.png" alt="Imagen 1"> <!-- Reemplaza con la URL de tu primera imagen -->
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_tramite.png" alt="Imagen 2"> <!-- Reemplaza con la URL de tu segunda imagen -->
    </div>

    @if(session('error'))
        <div class="card card-alert">
            <strong class="alert alert-danger">
                {{ session('error') }}
            </strong>
        </div>
    @endif

    <div class="container">
    <!-- Card 1: Licencia de Funcionamiento -->
        <div class="card">
            <div class="card-icon">&#x1F4C4;</div> <!-- Icono de documento en verde -->
            <h2>Licencia de Funcionamiento</h2>
            <p>Ingresa para iniciar los trámites de licencia de funcionamiento.</p>
            <button class="card-button" 
                @auth
                onclick="window.location.href='{{ route('licencias') }}'"
                @else
                onclick="window.location.href='{{ route('login') }}'"
                @endauth
                >Ingresar
            </button>
        </div>

        <!-- Card 2: Consultas -->
        <div class="card">
            <div class="card-icon">&#x1F50D;</div> <!-- Icono de lupa en verde -->
            <h2>Consultas</h2>
            <p>Ingresa para consultar tus trámites, hacer seguimiento y verificar en qué estado se encuentran.</p>
            <button class="card-button" onclick="showTramiteStatus()">Consultar</button>
        </div>
    </div>
    <script>
        function showTramiteStatus(){
            const code = prompt('Introduzca su código de tramite');
            if(code){
                window.location.href = "{{ route('tramite.consulta', '') }}" + '/' + code;
            } else {
                alert('Debe llenar la casilla con algun código');
            }   
        }
    </script>
</body>
</html>
