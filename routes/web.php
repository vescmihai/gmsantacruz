<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

use App\Models\TipoLicencia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitanteController;
use App\Http\Controllers\TipoLicenciaController;
use App\Http\Controllers\TramiteController;

// No login
Route::get('/', function () {
    return view('welcome');
})->name('ruta.principal');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function (){
        return redirect()->route('login-metamask');
    })->name('login');
    Route::get('/login-metamask', [AuthController::class, 'showLoginForm'])->name('login-metamask'); // Muestra el formulario de login con MetaMask
    Route::post('/login-metamask', [AuthController::class, 'loginWithMetaMask'])->name('login-metamask.post'); // Maneja el login con MetaMask
});

// Login
Route::group(['middleware' => 'auth'], function () {
    // Wallet info
    Route::get('/wallet-info', function (Request $request) { 
        return view('wallet-info', ['address' => $request->query('address')]);
    })->name('wallet-info');

    // Vista de los tipos de licencias
    Route::get('/licencias', function () {
        return view('licencias', ['tipos' => TipoLicencia::all()]);
    })->name('licencias');

    // Vista para las operaciones del tipo de licencia seleccionada
    Route::get('/tipo', [TipoLicenciaController::class, 'operations'])->name('tipo');

    // Tramite
    Route::prefix('tramite')->group(function () {
        // Solicitante
        Route::get('/solicitante', [SolicitanteController::class, 'index'])->name('tramite.solicitante');
        Route::get('/solicitante/datos', [SolicitanteController::class, 'show'])->name('solicitante.show');
        Route::post('/solicitante/save', [SolicitanteController::class, 'save'])->name('solicitante.save');
        Route::post('/solicitante/upload-file', [SolicitanteController::class, 'uploadFile'])->name('solicitante.uploadFile');
        Route::get('/solicitante/resultado', [SolicitanteController::class, 'guardarSolicitante'])->name('solicitante.resultado');

        // Tramite
        Route::get('/{codigo}', [TramiteController::class, 'consulta'])->name('tramite.consulta');
    });
});