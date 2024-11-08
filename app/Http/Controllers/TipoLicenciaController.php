<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TipoLicencia;

class TipoLicenciaController extends Controller
{
    public function operations(Request $request){
        // Revisar que solo sean codigos de la BD
        $codigoLicencia = $request->query('codigo', 'otros');
        if(!!!TipoLicencia::where('codigo', $codigoLicencia)->first()){
            $codigoLicencia = 'otros';
        }

        return view('tipo', ['codigo' => $codigoLicencia]);
    }
}
