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
            position: relative; 
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
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-top: 2rem; 
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        #loginButton {
            background-color: #ff9900;
            border: none;
            padding: 0.8rem 1.5rem;
            color: white;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            display: block; 
            margin: 1rem auto; 
        }

        #loginButton:hover {
            background-color: #ff7700;
            transform: translateY(-3px);
        }

        #loginButton:active {
            background-color: #cc7a00;
            transform: translateY(0);
        }

        .metamask-logo {
            width: 150px;
            margin: 1rem auto;
            display: block;
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

        p {
            margin-top: 1rem;
            font-size: 1rem;
            color: #666;
        }

        .alert {
            color: #ff3e3e;
            margin-top: 1rem;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .link {
            margin-top: 1rem;
            font-size: 0.9rem;
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
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_sc.png" alt="Imagen 1"> 
        <img src="https://tramites-digitales.gmsantacruz.gob.bo/assets/images/blocks/hero/logo_tramite.png" alt="Imagen 2"> 
    </div>

    <div class="container">
        <h1>Autenticación con MetaMask</h1>
        <div id="metamaskForm">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/36/MetaMask_Fox.svg" alt="MetaMask Logo" class="metamask-logo">
            <button id="loginButton">Iniciar sesión con MetaMask</button>
            <p>Conecte su billetera MetaMask para gestionar las licencias.</p>
            <div class="link">
                <p><a href="https://metamask.io/es/" target="_blank">¿No tienes MetaMask?</a>.</p>
            </div>
        </div>
        <img id="loader" src="/images/loader.svg" alt="loader" width="70" style="display: none"/>
        <div id="alertMessage" class="alert" style="display: none;">MetaMask no está instalado!</div>

        <form id="loginForm" action="{{ route('login-metamask.post') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="address" id="walletAddress">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script>
    const loginButton = document.getElementById('loginButton');
    const walletAddressInput = document.getElementById('walletAddress');
    const loginForm = document.getElementById('loginForm');
    const alertMessage = document.getElementById('alertMessage');
    const metamaskForm = document.getElementById('metamaskForm');
    const loader = document.getElementById('loader');

    if (typeof window.ethereum !== 'undefined') {
        const web3 = new Web3(window.ethereum);

        loginButton.addEventListener('click', async () => {
            try {
                metamaskForm.style.display = "none";
                loader.style.display = "inline";

                // Solicitar al usuario que conecte MetaMask
                const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
                const walletAddress = accounts[0];

                // Asignar la dirección de MetaMask al campo oculto
                walletAddressInput.value = walletAddress;

                // Login or create user
                const response = await fetch(loginForm.action, {method:'post', body: new FormData(loginForm)});
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const json = await response.json();
                console.log(json);
                // window.location.href = `/wallet-info?address=${walletAddress}`; // Ajusta la ruta según tu configuración
                window.location.href = `/licencias`;
            } catch (error) {
                metamaskForm.style.display = "block";
                loader.style.display = "none";

                console.error('Error durante el inicio de sesión con MetaMask', error);
            }
        });
    } else {
        alertMessage.style.display = 'block';
    }
</script>

</body>
</html>
