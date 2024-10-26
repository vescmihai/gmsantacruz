<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Datos del Solicitante</title>
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

    <!-- Banner Background -->
    <div class="banner"></div>

    <div class="container mt-5 position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col col-lg-5 col-md-7 col-12">
                <div class="card shadow px-lg-5 px-md-5 px-5 py-5 rounded-4 border-0" data-aos="zoom-in">
                    <h3 class="text-center mb-5">Datos del Solicitante <i class="bi bi-person-fill"></i></h3>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Tipo de Solicitante</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoSolicitante" id="personalNatural" value="natural">
                                <label class="form-check-label" for="personalNatural">Personal Natural</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoSolicitante" id="personaJuridica" value="juridica">
                                <label class="form-check-label" for="personaJuridica">Persona Jurídica</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="documento" class="form-label">Nro de Documento (*)</label>
                            <input type="text" class="form-control py-2" id="documento" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres (*)</label>
                            <input type="text" class="form-control py-2" id="nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="primerApellido" class="form-label">Primer apellido (*)</label>
                            <input type="text" class="form-control py-2" id="primerApellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="segundoApellido" class="form-label">Segundo apellido</label>
                            <input type="text" class="form-control py-2" id="segundoApellido">
                        </div>
                        <div class="mb-3">
                            <label for="tercerApellido" class="form-label">Tercer apellido</label>
                            <input type="text" class="form-control py-2" id="tercerApellido">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección (*)</label>
                            <input type="text" class="form-control py-2" id="direccion" required>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary w-100 py-2 mb-2">Documento de identidad Anverso</button>
                            <button type="button" class="btn btn-outline-primary w-100 py-2">Documento de identidad Reverso</button>
                        </div>

                        <p class="text-muted mt-4">Los campos con (*) son obligatorios.</p>

                        <button type="submit" class="btn btn-primary w-100 py-lg-3 py-md-2 py-2 shadow-sm mt-4">Enviar <i class="bi bi-check-circle-fill"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/script.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
