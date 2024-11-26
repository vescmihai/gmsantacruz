<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\TipoLicencia;
use App\Models\Notificacion;
use App\Models\Tramite;

class TipoLicenciaController extends Controller
{
    public function operations(Request $request){
        $codigo = $request->query('codigo', 'otros');
        if(!!!TipoLicencia::where('codigo', $codigo)->first()){
            $codigo = 'otros';
        }

        $user = Auth::user();
        $tramites = Tramite::with('estadoTramite', 'tipoLicencia')->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        $notificaciones = Notificacion::where('user_id', $user->id)->orderBy('id', 'DESC')->limit(5)->get();

        return view('tipo', compact('codigo', 'tramites', 'notificaciones'));
    }
}
