<?php

namespace App\Http\Controllers;

use App\Services\PinataService;
use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    protected $pinataService;

    public function __construct(PinataService $pinataService)
    {
        $this->pinataService = $pinataService;
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
        ]);

        $request->session()->put('datos', $validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Datos guardados correctamente.',
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
