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
        }

        .container {
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Autenticación con MetaMask</h1>
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/36/MetaMask_Fox.svg" alt="MetaMask Logo" class="metamask-logo">
        <button id="loginButton">Iniciar sesión con MetaMask</button>
        <p>Conecte su billetera MetaMask para gestionar las licencias.</p>
        <div class="link">
            <p><a href="https://metamask.io/es/" target="_blank">¿No tienes MetaMask?</a>.</p>
        </div>
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

        if (typeof window.ethereum !== 'undefined') {
            const web3 = new Web3(window.ethereum);

            loginButton.addEventListener('click', async () => {
                try {
                    // Solicitar al usuario que conecte MetaMask
                    const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
                    const walletAddress = accounts[0];

                    // Asignar la dirección de MetaMask al campo oculto
                    walletAddressInput.value = walletAddress;

                    // Enviar el formulario
                    loginForm.submit();
                } catch (error) {
                    console.error('Error durante el inicio de sesión con MetaMask', error);
                }
            });
        } else {
            alertMessage.style.display = 'block';
        }
    </script>
</body>
</html>
