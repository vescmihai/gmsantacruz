<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request; 
use App\Http\Controllers\SolicitanteController;

Route::get('/solicitante/datos', [SolicitanteController::class, 'show'])->name('solicitante.show');
Route::post('/solicitante/save', [SolicitanteController::class, 'save'])->name('solicitante.save');
Route::post('/solicitante/upload-file', [SolicitanteController::class, 'uploadFile'])->name('solicitante.uploadFile');
Route::get('/solicitante/resultado', [SolicitanteController::class, 'guardarSolicitante'])->name('solicitante.resultado');

Route::get('/login-metamask', [AuthController::class, 'showLoginForm'])->name('login-metamask'); // Muestra el formulario de login con MetaMask
Route::post('/login-metamask', [AuthController::class, 'loginWithMetaMask'])->name('login-metamask.post'); // Maneja el login con MetaMask

Route::get('/wallet-info', function (Request $request) { 
    return view('wallet-info', ['address' => $request->query('address')]);
})->name('wallet-info');

Route::get('/', function () {
    return view('welcome');
})->name('ruta.principal');

Route::get('/licencias', function () {
    return view('licencias');
})->name('licencias');

Route::get('/tipo', function () {
    return view('tipo'); 
})->name('tipo');

Route::get('/formulario', function () {
    return view('formulario');
})->name('formulario');
