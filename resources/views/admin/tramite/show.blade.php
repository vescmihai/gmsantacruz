<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <style>
      body {
        font-size: .875rem;
      }

      .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
      }

      /*
      * Sidebar
      */

      .sidebar {
        position: fixed;
        top: 0;
        /* rtl:raw:
        right: 0;
        */
        bottom: 0;
        /* rtl:remove */
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      }

      @media (max-width: 767.98px) {
        .sidebar {
          top: 5rem;
        }
      }

      .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
      }

      .sidebar .nav-link {
        font-weight: 500;
        color: #333;
      }

      .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #727272;
      }

      .sidebar .nav-link.active {
        color: #2470dc;
      }

      .sidebar .nav-link:hover .feather,
      .sidebar .nav-link.active .feather {
        color: inherit;
      }

      .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
      }

      /*
      * Navbar
      */

      .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
      }

      .navbar .navbar-toggler {
        top: .25rem;
        right: 1rem;
      }

      .navbar .form-control {
        padding: .75rem 1rem;
        border-width: 0;
        border-radius: 0;
      }

      .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
      }

      .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
      }

      .bg-color {
        background-color: #28a745;
      }

      .nav-link-color {
        color: white;
      }
    </style>
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-color flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Panel GMS</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link nav-link-color px-3" href="{{ route('logout') }}">Salir</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              Tramites
            </a>
          </li>
          @if ($user->rol->name == 'admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.funcionarios') }}">
                Funcionarios
              </a>
            </li>
          @endif
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @if (session('message'))
        <br/>
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
      @endif
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tramite #{{ $tramite->id }}</h1>
      </div>

      <div class="d-flex flex-row m-2">
      @foreach ($estadoTramites as $estadoTramite)
        @if ($estadoTramite->id != $tramite->estadoTramite->id)
          <form method="POST" action="{{ route('admin.changeTramiteState') }}" class="mx-2">
            <input name="tramiteId" type="hidden" value="{{ $tramite->id }}"/>
            <input name="estadoTramiteId" type="hidden" value="{{ $estadoTramite->id }}"/>
            @csrf
            <button id="sendButton" type="submit" class="btn btn-dark" style="background-color: {{ $estadoTramite->color }}">
              {{ $estadoTramite->nombre }} <i class="bi bi-check-circle-fill"></i>
            </button>
          </form>
        @endif
      @endforeach
      </div>

      <div class="container">
        <div>
        <h3>Datos Recuperados del Tramite</h3>
        <ul class="list-group">
            <li class="list-group-item"><strong>Código:</strong> {{ $tramite['codigo'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Fecha de solicitud:</strong> {{ $tramite['created_at']->format('d-m-Y h:i:s A') ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $tramite['estadoTramite']['nombre'] ?? 'No disponible' }}</li>
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

    </main>
  </div>
</div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  </body>
</html>
