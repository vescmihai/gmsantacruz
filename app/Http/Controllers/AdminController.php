<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\EstadoTramite;
use App\Models\Tramite;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request) {
        // Get User and Rol for Permission configuration
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        // TODO: Mejorar el panel. Enviando los tramites para cambiarlos de estado
        $tramites = Tramite::with('estadoTramite', 'solicitante', 'tipoLicencia')->get();

        return view('admin.dashboard', [
            'user' => $user,
            'tramites' => $tramites,
        ]);
    }

    public function changeTramiteEstadoMain(Request $request){
        // Update Tramite state
        $tramite = Tramite::find($request->tramiteId);
        $tramite->estado_tramite_id = $request->estadoTramiteId;
        $tramite->save();

        return redirect()->route('admin.dashboard')->with('message', 'Se cambio el estado del Tramite '. $tramite->codigo . ' a ' . $tramite->estadoTramite->nombre);
    }

    public function getTramite(Request $request){
        // Get User and Rol for Permission configuration
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        $tramite = Tramite::with('estadoTramite', 'solicitante', 'tipoLicencia')->find($request->id);
        $estadoTramites = EstadoTramite::get();
        
        if($tramite){
            return view('admin.tramite.show', [
                'tramite' => $tramite,
                'estadoTramites' => $estadoTramites,
                'user' => $user
            ]);
        } else {
            return redirect()->route('admin.dashboard')->with('message', 'No existe el tramite seleccionado');
        }
    }

    public function getFuncionarios(Request $requets) {
        return;
    }
}
