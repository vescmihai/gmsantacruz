<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

// para mostrar el formulario de login con MetaMask
Route::get('/login-metamask', [AuthController::class, 'showLoginForm'])->name('login-metamask');

// para manejar el login con MetaMask (método POST)
Route::post('/login-metamask', [AuthController::class, 'loginWithMetaMask'])->name('login-metamask.post');

Route::get('/', function () {
    return view('welcome');
});
