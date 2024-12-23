<?php

namespace App\Http\Controllers;

use App\Services\PinataService;

use Illuminate\Http\Request;

use App\Models\Tramite;
use App\Models\Licencia;
use App\Models\Notificacion;

class TramiteController extends Controller
{
    protected $pinataService;

    public function __construct(PinataService $pinataService)
    {
        $this->pinataService = $pinataService;
    }

    public function consulta(Request $request){
        $tramite = Tramite::with('solicitante', 'estadoTramite')->where('codigo', $request->codigo)->first();
        if($tramite) {
            $lastNotification = Notificacion::where('tramite_id', $tramite->id)->orWhere('user_id', $tramite->user_id)->orderBy('id', 'DESC')->first();
            $licencia = Licencia::with('tramite')->where('tramite_id', $tramite->id)->orderBy('id', 'DESC')->first();
            return view('tramite.datos', compact('tramite', 'lastNotification', 'licencia'));
        } 

        return redirect()->route('ruta.principal')->with('error', 'No se encontro el tramite.');
    }

    public function licenciaVerificar(Request $request) {
        $licenciaVerificada = $request->licenciaVerificada;
        $licencia = Licencia::with('tramite')->where('documento', $licenciaVerificada)->first();

        if($licencia){
            // Se encontro la licencia
            return response()->json(['licencia' => $licencia, 'message' => 'Licencia Valida.']);
        } else {
            // No se encontro, borrar el CID que se subio de Pinata
            $this->pinataService->deleteIPFS($licenciaVerificada);
            return response()->json(['error' => 'No existe dicha licencia.'], 500);
        }
    }
}
