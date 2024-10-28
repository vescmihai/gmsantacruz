<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request; 
use App\Http\Controllers\SolicitanteController;

Route::get('/solicitante/datos', [SolicitanteController::class, 'show'])->name('solicitante.show');
Route::post('/solicitante/save', [SolicitanteController::class, 'save'])->name('solicitante.save');



// Para mostrar el formulario de login con MetaMask
Route::get('/login-metamask', [AuthController::class, 'showLoginForm'])->name('login-metamask');

// Para manejar el login con MetaMask (método POST)
Route::post('/login-metamask', [AuthController::class, 'loginWithMetaMask'])->name('login-metamask.post');

// Ruta para mostrar la información de la wallet
Route::get('/wallet-info', function (Request $request) { 
    return view('wallet-info', ['address' => $request->query('address')]);
})->name('wallet-info');


Route::get('/', function () {
    return view('welcome');
})->name('ruta.principal');

Route::get('/licencias', function () {
    return view('licencias');
});

Route::get('/tipo', function () {
    return view('tipo'); 
})->name('tipo');

Route::get('/formulario', function () {
    return view('formulario');
})->name('formulario');
