<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        if (!$user) {
            $user = User::create([
                'wallet_address' => $userAddress,
                'name' => 'User_' . substr($userAddress, 0, 6), // Nombre temporal
            ]);
        }

        Auth::login($user);

        return response()->json(['message' => 'Login exitoso', 'user' => $user]);
    }
}
