<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <title>Tipo de Trámite</title>
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
        .button-logout{
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.2rem 1rem;
        }
        .menu-drop{
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.2rem 0;
        }
        .menu-drop button{
            background-color: #28a745 !important;
        }
        .menu-drop button:hover{
            background-color: #218838 !important;
        }
    </style>
</head>
<body>
    <div class="banner"></div>

    <div class="additional-images">
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_sc.png" alt="Imagen 1">
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_tramite.png" alt="Imagen 2">
    </div>

    @auth
        <button type="button" class="card-button button-logout" 
            onclick="window.location.href='{{ route('logout') }}'">
            <span>Salir</span>
        </button>

        <div class="dropdown  menu-drop">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menú
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/">Inicio</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#tramiteModal">Mis Trámites</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#notificarModal">Notificaciones</a></li>
            </ul>
        </div>
        
        <!-- Modal Tramites -->
        <div class="modal fade" id="tramiteModal" tabindex="-1" aria-labelledby="tramiteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="tramiteModalLabel">Mis Trámites</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Tipo de Licencia</th>
                              <th scope="col">Estado</th>
                              <th scope="col">Válido hasta</th>
                              <th scope="col">Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($tramites as $tramite)
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $tramite->tipoLicencia->nombre }}</td>
                                <td>{{ $tramite->estadoTramite->nombre }}</td>
                                <td>{{ date('Y-m-d', strtotime($tramite->valido_hasta)) }} @if ($tramite->valido_hasta > now())
                                  (Válido)
                                @else
                                  (Expirado)
                                @endif</td>
                                <td>
                                  <a href="{{ route('tramite.consulta', ['codigo' => $tramite->codigo]) }}">Ver Tramite</a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal Notificaciones -->
        <div class="modal fade" id="notificarModal" tabindex="-1" aria-labelledby="notificarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="notificarModalLabel">Centro de Notificaciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        @foreach($notificaciones as $notificacion)
                        <a href="@if($notificacion->enlace) {{ $notificacion->enlace }} @else {{ '#' }} @endif" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1"><strong>{{ $notificacion->titulo }}</strong></h5>
                              <small>{{ date('Y-m-d', strtotime($notificacion->created_at)) }}</small>
                            </div>
                            <p class="mb-1">{{ $notificacion->mensaje }}</p>
                            @if($notificacion->enlace)<small>Click para ver más</small>@endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>

    @endauth

    <div class="container">
        <!-- Card 1 -->
        <div class="card">
            <div class="card-icon">&#x1F5C3;</div> <!-- Nuevo Documento -->
            <h2>Nueva Licencia de Funcionamiento</h2>
            <a href="{{ route('tramite.solicitante', ['codigo' => $codigo]) }}" class="card-button">Ingresar</a>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <div class="card-icon">&#x1F4C6;</div> <!-- Actualizar Documento -->
            <h2>Actualizar Licencia de Funcionamiento</h2>
            <a href="{{ route('tramite.solicitante', ['codigo' => $codigo]) }}" class="card-button">Ingresar</a>
        </div>

        <!-- Card 3 -->
        <div class="card">
            <div class="card-icon">&#x1F5D1;</div> <!-- Baja Documento -->
            <h2>Baja Licencia de Funcionamiento</h2>
            <a href="{{ route('tramite.solicitante', ['codigo' => $codigo]) }}" class="card-button">Ingresar</a>
        </div>

        <!-- Card 4 -->
        <div class="card">
            <div class="card-icon">&#x1F5D8;</div> <!-- Información -->
            <h2>Información para la baja por inactividad de Licencia de Funcionamiento</h2>
            <a href="{{ route('tramite.solicitante', ['codigo' => $codigo]) }}" class="card-button">Ingresar</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
