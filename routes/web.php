<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

use App\Models\TipoLicencia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitanteController;

// No login
Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('licencias');
    } else {
        return view('welcome');
    }
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

    // Solicitante
    Route::get('/solicitante/datos', [SolicitanteController::class, 'show'])->name('solicitante.show');
    Route::post('/solicitante/save', [SolicitanteController::class, 'save'])->name('solicitante.save');
    Route::post('/solicitante/upload-file', [SolicitanteController::class, 'uploadFile'])->name('solicitante.uploadFile');
    Route::get('/solicitante/resultado', [SolicitanteController::class, 'guardarSolicitante'])->name('solicitante.resultado');

    Route::get('/wallet-info', function (Request $request) { 
        return view('wallet-info', ['address' => $request->query('address')]);
    })->name('wallet-info');

    Route::get('/licencias', function () {
        return view('licencias', ['tipos' => TipoLicencia::all()]);
    })->name('licencias');

    Route::get('/tipo', function (?string $codigo = 'otros') {
        return view('tipo', ['codigo' => $codigo]);
    })->name('tipo');

    Route::prefix('tramite')->group(function () {
        Route::get('/solicitante', function (?string $codigo = 'otros') {
            return view('solicitante', ['codigo' => $codigo]);
        })->name('tramite.solicitante');
    });
});