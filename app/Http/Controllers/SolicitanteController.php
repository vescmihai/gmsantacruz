<?php

namespace App\Http\Controllers;

use App\Services\PinataService;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\TipoLicencia;
use App\Models\Solicitante;
use App\Models\Tramite;
use App\Models\EstadoTramite;

class SolicitanteController extends Controller
{
    protected $pinataService;

    public function __construct(PinataService $pinataService)
    {
        $this->pinataService = $pinataService;
    }

    public function index(Request $request){
        $codigoLicencia = $request->query('codigo', 'otros');
        if(!!!TipoLicencia::where('codigo', $codigoLicencia)->first()){
            $codigoLicencia = 'otros';
        }

        return view('solicitante', ['codigo' => $codigoLicencia]);
    }

    public function show(Request $request)
    {
        $datos = $request->session()->get('datos', null);

        if (!$datos) {
            return redirect()->route('ruta.principal')->with('error', 'No se encontraron datos en la sesión.');
        }

        return view('solicitante.datos', compact('datos'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'tipoSolicitante' => 'required|string',
            'documento' => 'required|string',
            'nombres' => 'required|string',
            'primerApellido' => 'required|string',
            'segundoApellido' => 'nullable|string',
            'tercerApellido' => 'nullable|string',
            'direccion' => 'required|string',
            'documentoAnverso' => 'required|string',
            'documentoReverso' => 'required|string',
            'codigo' => 'required|string'
        ]);

        $tipoLicencia = TipoLicencia::where('codigo', $validatedData['codigo'])->first();
        $estadoTramite = EstadoTramite::where('nombre', 'Pendiente')->first();

        // Generar Solicitante
        $solicitante = Solicitante::create([
            'tipo' => $validatedData['tipoSolicitante'],
            'nro_documento' => $validatedData['documento'],
            'nombres' => $validatedData['nombres'],
            'primer_apellido' => $validatedData['primerApellido'],
            'segundo_apellido' => $validatedData['segundoApellido'],
            'tercer_apellido' => $validatedData['tercerApellido'],
            'direccion' => $validatedData['direccion'],
            'documento_anverso' => $validatedData['documentoAnverso'],
            'documento_reverso' => $validatedData['documentoReverso']
        ]);

        // Generar Tramite
        $tramite = new Tramite();
        $tramite->codigo = Str::uuid();
        $tramite->user_id = Auth::id();
        $tramite->solicitante_id = $solicitante->id;
        $tramite->tipo_licencia_id = $tipoLicencia->id;
        $tramite->estado_tramite_id = $estadoTramite->id;
        $tramite->valido_hasta = now()->addYear();
        $tramite->save();

        $request->session()->put('datos', $validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Datos guardados correctamente.',
            'data' => $tramite->codigo,
            'redirect' => route('solicitante.resultado') 
        ]);
    }

    public function uploadFile(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'file.required' => 'Es necesario seleccionar un archivo.',
            'file.mimes' => 'El archivo debe ser de tipo jpg, jpeg, png o pdf.',
            'file.max' => 'El tamaño del archivo no debe superar los 2MB.'
        ]);

        try {
            $file = $validatedData['file'];

            $ipfsHash = $this->pinataService->uploadToIPFS($file);

            return response()->json(['ipfsHash' => $ipfsHash, 'message' => 'Archivo subido correctamente a IPFS.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al subir el archivo: ' . $e->getMessage()], 500);
        }
    }

    public function guardarSolicitante(Request $request)
    {
        $datos = $request->session()->get('datos', null);

        if (!$datos) {
            return redirect()->route('ruta.principal')->with('error', 'No se encontraron datos en la sesión.');
        }

        return view('solicitante.resultado', compact('datos'));
    }

    public function resultado(Request $request)
    {
        $datos = $request->session()->get('datos');

        return view('resultado', ['datos' => $datos]);
    }
}
