import './bootstrap';
import Web3 from 'web3';

window.ethereum.request({ method: 'eth_requestAccounts' }).then(accounts => {
    if (accounts.length > 0) {
        const web3 = new Web3(window.ethereum);
        const userAddress = accounts[0];

        // Enviar la dirección al servidor Laravel
        axios.post('/login-metamask', { address: userAddress })
            .then(response => {
                console.log('Login exitoso:', response.data);
            })
            .catch(error => {
                console.error('Error en el login:', error);
            });
    } else {
        console.error('No se encontraron cuentas en MetaMask');
    }
}).catch(error => {
    console.error('MetaMask Error:', error);
});

