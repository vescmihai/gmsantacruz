<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Tramite;
use App\Models\Notificacion;
use App\Models\TipoLicencia;

class HomeController extends Controller
{
    public function home(Request $request) {
        if(Auth::check()){
            $user = Auth::user();
            $tramites = Tramite::with('estadoTramite', 'tipoLicencia')->where('user_id', $user->id)->get();
            $notificaciones = Notificacion::where('user_id', $user->id)->get();

            return view('welcome', compact('tramites', 'notificaciones'));
        }
        return view('welcome');
    }

    public function licencias(Request $request) {
        $user = Auth::user();
        $tramites = Tramite::with('estadoTramite', 'tipoLicencia')->where('user_id', $user->id)->get();
        $notificaciones = Notificacion::where('user_id', $user->id)->get();
        $tipos = TipoLicencia::all();

        return view('licencias', compact('tramites', 'notificaciones', 'tipos'));
    }
}
