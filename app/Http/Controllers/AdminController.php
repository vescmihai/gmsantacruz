<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request) {
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        return view('admin.dashboard', ['user' => $user]);
    }
}
