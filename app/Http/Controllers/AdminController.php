<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\EstadoTramite;
use App\Models\Notificacion;
use App\Models\Rol;
use App\Models\Tramite;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request) {
        // Get User and Rol for Permission configuration
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        // TODO: Mejorar el panel. Enviando los tramites para cambiarlos de estado
        $tramites = Tramite::with('estadoTramite', 'solicitante', 'tipoLicencia')->orderBy('id', 'DESC')->get();

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

        if($request->mensaje) {
            $estadoTramite = EstadoTramite::find($request->estadoTramiteId);

            $notificacion = new Notificacion();
            $notificacion->titulo = "Su trámite ha sido " . $estadoTramite->nombre;
            $notificacion->mensaje = $request->mensaje;
            $notificacion->user_id = $tramite->user_id;
            $notificacion->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Se cambio el estado del Tramite '. $tramite->codigo . ' a ' . $tramite->estadoTramite->nombre,
            'redirect' => route('admin.dashboard')
        ]);
    }

    public function renewTramite(Request $request) {
        // Update Tramite state
        $tramite = Tramite::find($request->tramiteId);
        $tramite->valido_hasta = now()->addYear();
        $tramite->save();

        return redirect()->route('admin.dashboard')->with('message', 'Se renovó la validez del Tramite '. $tramite->codigo);
    }

    public function getTramite(Request $request){
        // Get User and Rol for Permission configuration
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        $tramite = Tramite::with('estadoTramite', 'solicitante', 'tipoLicencia')->find($request->id);
        
        // Solo mostrar otras opciones si esta en pendiente
        if($tramite->estadoTramite->nombre == 'Pendiente'){
            $estadoTramites = EstadoTramite::get();
        } else {
            $estadoTramites = [];
        }
        
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
        // Get User and Rol for Permission configuration
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        $funcionarios = User::whereHas('rol', function(Builder $query){
            $query->where('name', 'funcionario');
        })->get();

        return view('admin.funcionario.index', [
            'funcionarios' => $funcionarios,
            'user' => $user
        ]);
    }

    public function createFuncionarios(Request $request) {
        // Get User and Rol for Permission configuration
        $user_id = Auth::id();
        $user = User::with('rol')->find($user_id);

        return view('admin.funcionario.create')->with('user', $user);
    }

    public function storeFuncionarios(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $funcionario_rol = Rol::where('name', 'funcionario')->first();

        try {
            $funcionario = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'rol_id' => $funcionario_rol->id,
                'wallet_address' => '0x' . Str::random(12),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('admin.funcionarios')->with('message', 'Funcionario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.funcionarios')->with('error', 'Error con los datos ingresados.');
        }
    }
}
