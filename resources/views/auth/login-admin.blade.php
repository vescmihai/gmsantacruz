<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
      <title>Acceso al Panel Administrativo</title>
      <style>
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
         .btn-outline-primary {
         border-color: #cccccc; 
         color: #0d6efd; 
         }
         .btn-outline-primary:hover {
         background-color: #0d6efd; 
         color: #fff; 
         }
      </style>
   </head>
   <body>
      <div class="banner"></div>
      <div class="container mt-5 position-relative" style="z-index: 1;">
         <div class="row justify-content-center">
            <div class="col col-lg-5 col-md-7 col-12">
               <div class="card shadow px-lg-5 px-md-5 px-5 py-5 rounded-4 border-0" data-aos="zoom-in">
                  <h3 class="text-center mb-5">Acceso al Usuario <i class="bi bi-person-fill"></i></h3>
                  <form id="solicitanteForm" method="POST" action="{{ route('login-admin.post') }}">
                     @csrf
                     <div class="mb-3">
                        <label for="email" class="form-label">Correo (*)</label>
                        <input type="text" class="form-control py-2" id="email" required name="email">
                     </div>
                     <div class="mb-3">
                        <label for="password" class="form-label">Contraseña (*)</label>
                        <input type="password" class="form-control py-2" id="password" required name="password">
                     </div>
                     <button id="sendButton" type="submit" class="btn btn-primary w-100 py-lg-3 py-md-2 py-2 shadow-sm mt-4">
                        Enviar <i class="bi bi-check-circle-fill"></i>
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>