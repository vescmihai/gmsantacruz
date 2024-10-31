<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/web3@1.7.0/dist/web3.min.js"></script>
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
    <div class="banner"></div>

    <div class="container mt-5 position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col col-lg-5 col-md-7 col-12">
                <div class="card shadow px-lg-5 px-md-5 px-5 py-5 rounded-4 border-0" data-aos="zoom-in">
                    <h3 class="text-center mb-5">Datos del Solicitante <i class="bi bi-person-fill"></i></h3>
                    <form id="solicitanteForm">
                        <div class="mb-3">
                            <label class="form-label">Tipo de Solicitante</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoSolicitante" id="personalNatural" value="natural" required>
                                <label class="form-check-label" for="personalNatural">Personal Natural</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoSolicitante" id="personaJuridica" value="juridica" required>
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

                        <form id="solicitanteForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="documentoAnverso" class="form-label">Documento de Identidad Anverso (*)</label>
                            <input type="file" class="form-control py-2" id="documentoAnverso" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="documentoReverso" class="form-label">Documento de Identidad Reverso (*)</label>
                            <input type="file" class="form-control py-2" id="documentoReverso" accept="image/*" required>
                        </div>
                    </form>


                        <button type="button" onclick="connectToBlockchain(); saveToBlockchain()" class="btn btn-primary w-100 py-lg-3 py-md-2 py-2 shadow-sm mt-4">
                            Enviar <i class="bi bi-check-circle-fill"></i>
                        </button>

                    </form>

                    <div id="datosRecuperados" class="mt-4" style="display: none;">
                        <h5>Datos Recuperados:</h5>
                        <p id="datosSolicitante"></p>
                        <button type="button" onclick="fetchDataFromBlockchain()" class="btn btn-outline-primary w-100 py-lg-3 py-md-2 py-2 mt-3 shadow-sm">
                            Recuperar Datos <i class="bi bi-box-arrow-down"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        let web3;
        let contract;

        async function connectToBlockchain() {
            if (window.ethereum) {
                web3 = new Web3(window.ethereum);
                await window.ethereum.request({ method: 'eth_requestAccounts' });
                const contractAddress = '0xA0fb08FE98b9b4577aCc08792d46aBe122eB0738';
                const abi = [
                    
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_tipo",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_documento",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_nombres",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_primerApellido",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_segundoApellido",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_tercerApellido",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_direccion",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_documentoAnverso",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_documentoReverso",
				"type": "string"
			}
		],
		"name": "guardarSolicitante",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"name": "solicitantes",
		"outputs": [
			{
				"internalType": "string",
				"name": "tipo",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "documento",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "nombres",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "primerApellido",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "segundoApellido",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "tercerApellido",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "direccion",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "documentoAnverso",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "documentoReverso",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}

                ];
                contract = new web3.eth.Contract(abi, contractAddress);
            } else {
                alert('Por favor, instala Metamask para usar esta aplicación.');
            }
        }

        async function saveToBlockchain() {
            try {
                const tipoSolicitante = document.querySelector('input[name="tipoSolicitante"]:checked').value;
                const documento = document.getElementById('documento').value;
                const nombres = document.getElementById('nombres').value;
                const primerApellido = document.getElementById('primerApellido').value;
                const segundoApellido = document.getElementById('segundoApellido').value || '';
                const tercerApellido = document.getElementById('tercerApellido').value || '';
                const direccion = document.getElementById('direccion').value;

                const documentoAnverso = await uploadFileToIPFS('documentoAnverso');
                const documentoReverso = await uploadFileToIPFS('documentoReverso');

                const accounts = await web3.eth.getAccounts();
                
                await contract.methods.guardarSolicitante(tipoSolicitante, documento, nombres, primerApellido, segundoApellido, tercerApellido, direccion, documentoAnverso, documentoReverso)
                    .send({ from: accounts[0] });

                const response = await fetch('{{ route('solicitante.save') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        tipoSolicitante,
                        documento,
                        nombres,
                        primerApellido,
                        segundoApellido,
                        tercerApellido,
                        direccion,
                        documentoAnverso,
                        documentoReverso
                    })
                });

                const data = await response.json();
                if (response.ok) {
                    alert('Datos guardados en la blockchain.');
                    document.getElementById('solicitanteForm').reset();
                    
                    window.location.href = data.redirect;
                } else {
                    alert('Error: ' + data.error);
                }
            } catch (error) {
                console.error('Error al guardar en blockchain:', error);
                alert('Hubo un error al guardar los datos. Por favor, revisa la consola para más detalles.');
            }
        }


        async function uploadFileToIPFS(inputId) {
            try {
                const fileInput = document.getElementById(inputId);
                const file = fileInput.files[0];

                if (!file) {
                    alert('Por favor, selecciona un archivo.');
                    return '';
                }

                const formData = new FormData();
                formData.append('file', file);

                const response = await fetch('{{ route('solicitante.uploadFile') }}', {
                    method: 'POST',
                    redirect: 'follow',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (response.ok) {
                    return data.ipfsHash;
                } else {
                    alert('Error al subir archivo a IPFS: ' + data.error);
                    return '';
                }
            } catch (error) {
                console.error('Error al cargar el archivo a IPFS:', error);
                alert('Error al subir archivo a IPFS.');
                return '';
            }
        }


        async function fetchDataFromBlockchain() {
            try {
                const accounts = await web3.eth.getAccounts();
                const data = await contract.methods.solicitantes(accounts[0]).call();

                const datosSolicitante = `Tipo: ${data[0]}, Documento: ${data[1]}, Nombres: ${data[2]}, Primer Apellido: ${data[3]}, Segundo Apellido: ${data[4]}, Tercer Apellido: ${data[5]}, Dirección: ${data[6]}`;
                document.getElementById('datosSolicitante').innerText = datosSolicitante;
            } catch (error) {
                console.error(error);
                alert('Error al recuperar los datos de la blockchain.');
            }
        }
        window.addEventListener('load', connectToBlockchain);
    </script>
</body>
</html>
