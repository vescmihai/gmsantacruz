<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de la Wallet</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            padding: 0;
            margin: 0;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            margin: 50px auto; 
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 2rem;
        }
        p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }
        .balance {
            font-weight: bold;
            font-size: 1.5rem;
            color: #4caf50; 
        }
        button {
            background-color: #ff9900;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background-color: #ff7700;
            transform: translateY(-2px);
        }
        button:active {
            background-color: #cc7a00;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Información de la Wallet</h1>
        <p id="walletAddress"></p>
        <p class="balance" id="walletBalance"></p>
        <button onclick="window.location.href='/'">Volver a Inicio</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script>
        window.onload = async function() {
            const urlParams = new URLSearchParams(window.location.search);
            const walletAddress = urlParams.get('address');
            document.getElementById('walletAddress').innerText = `Dirección de la Wallet: ${walletAddress}`;

            // Conectar a la wallet y obtener el balance
            if (typeof window.ethereum !== 'undefined') {
                const web3 = new Web3(window.ethereum);
                const balance = await web3.eth.getBalance(walletAddress);
                document.getElementById('walletBalance').innerText = `Balance: ${web3.utils.fromWei(balance, 'ether')} ETH`;
            }
        }
    </script>

</body>
</html>
