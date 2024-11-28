<?php

namespace App\Http\Controllers;

use App\Services\PinataService;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\EstadoTramite;
use App\Models\Licencia;
use App\Models\Notificacion;
use App\Models\Rol;
use App\Models\Tramite;
use App\Models\User;

class AdminController extends Controller
{
    protected $pinataService;

    public function __construct(PinataService $pinataService)
    {
        $this->pinataService = $pinataService;
    }

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
        $data = null;

        if($request->mensaje) {
            $estadoTramite = EstadoTramite::find($request->estadoTramiteId);

            $notificacion = new Notificacion();
            $notificacion->titulo = "Su trámite ha sido " . $estadoTramite->nombre;
            $notificacion->mensaje = $request->mensaje;
            $notificacion->user_id = $tramite->user_id;
            $notificacion->tramite_id = $tramite->id;
            $notificacion->save();

            try {
                if($estadoTramite->nombre == 'Aprobado') {
                    $tramiteNew = Tramite::with('solicitante', 'estadoTramite')->where('id', $request->tramiteId)->first();
                    $pdf = Pdf::loadView('tramite.datos', ['tramite' => $tramiteNew])->setOption(['isRemoteEnabled' => true]);
                    $ipfsHash = $this->pinataService->uploadContentToIPFS($pdf->output(), "licencia-" . Str::uuid() . ".pdf");

                    $licencia = new Licencia();
                    $licencia->tramite_id = $tramiteNew->id;
                    $licencia->user_id = Auth::id();
                    $licencia->documento = $ipfsHash;
                    $licencia->valido_hasta = now()->addYear();
                    $licencia->save();
 
                    return response()->json([
                        'success' => true,
                        'data' => $ipfsHash,
                        'message' => 'Se genero la licencia de funcionamiento correctamente. Puede descargarla en el siguiente enlace:',
                        'redirect' => route('admin.dashboard')
                    ]);
                }
            } catch(\Exception $e) {
                return response()->json([
                    'success' => false,
                    'data' => $e,
                    'message' => 'Error al guardar el PDF',
                    'redirect' => route('admin.dashboard')
                ]);
            }
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
            $lastNotification = Notificacion::where('tramite_id', $tramite->id)->orWhere('user_id', $tramite->user_id)->orderBy('id', 'DESC')->first();
            $licencia = Licencia::with('tramite')->where('tramite_id', $tramite->id)->orderBy('id', 'DESC')->first();
            return view('admin.tramite.show', [
                'tramite' => $tramite,
                'estadoTramites' => $estadoTramites,
                'user' => $user,
                'lastNotification' => $lastNotification,
                'licencia' => $licencia
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
