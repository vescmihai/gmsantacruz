<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Rol;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-metamask'); 
    }

    public function loginWithMetaMask(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
        ]);

        $userAddress = $request->input('address');

        $user = User::where('wallet_address', $userAddress)->first();
        $rol = Rol::where('name', 'cliente')->first();

        if (!$user) {
            $user = User::create([
                'wallet_address' => $userAddress,
                'name' => 'User_' . substr($userAddress, 0, 6), // Nombre temporal
                'rol_id' => $rol->id
            ]);
        }

        Auth::login($user);

        return response()->json(['message' => 'Login exitoso', 'user' => $user]);
    }
}
