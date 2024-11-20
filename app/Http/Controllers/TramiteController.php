<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tramite;

class TramiteController extends Controller
{
    public function consulta(Request $request){
        $tramite = Tramite::with('solicitante', 'estadoTramite')->where('codigo', $request->codigo)->first();
        if($tramite) {
            return view('tramite.datos', ['tramite' => $tramite]);
        } 

        return redirect()->route('ruta.principal')->with('error', 'No se encontro el tramite.');
    }
}
