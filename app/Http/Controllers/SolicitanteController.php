<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    public function show(Request $request)
    {
        // Verificar si 'datos' está en la sesión
        $datos = $request->session()->get('datos', null); // Usar 'null' como valor predeterminado

        // Verificar si los datos existen
        if (!$datos) {
            // Si no hay datos, puedes redirigir o mostrar un mensaje de error
            return redirect()->route('ruta.principal')->with('error', 'No se encontraron datos.');
        }

        return view('solicitante.datos', compact('datos'));
    }

    public function save(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'tipoSolicitante' => 'required|string',
            'documento' => 'required|string',
            'nombres' => 'required|string',
            'primerApellido' => 'required|string',
            'segundoApellido' => 'nullable|string',
            'tercerApellido' => 'nullable|string',
            'direccion' => 'required|string',
        ]);

        // Guardar los datos en la sesión
        $request->session()->put('datos', $validatedData);

        // Redirigir a la vista de datos con un mensaje de éxito
        return redirect()->route('solicitante.show')->with('success', 'Datos guardados correctamente.');
    }
}
